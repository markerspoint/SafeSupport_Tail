<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\StatusHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the authenticated student's appointments.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'upcoming');
        $query = Appointment::where('user_id', Auth::id())->with(['statusHistory', 'counselor']);

        if ($filter === 'past') {
            $appointments = $query->past()->get();
        } elseif ($filter === 'upcoming') {
            $appointments = $query->upcoming()->get();
        } elseif ($filter === 'pending') {
            $appointments = $query->where('status', 'pending')->orderBy('date', 'desc')->orderBy('time', 'desc')->get();
        } else {
            $appointments = $query->upcoming()->get();
        }

        return view('student.appointments', compact('appointments', 'filter'));
    }


    /**
     * Show the form for booking a new appointment.
     */
    public function create()
    {
        $counselors = User::where('role', 'counselor')->get(['id', 'name']);
        return view('student.appointments.create', compact('counselors'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
        ]);

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'counselor_id' => $request->counselor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        StatusHistory::create([
            'appointment_id' => $appointment->id,
            'status' => 'booked',
        ]);

        return redirect()->route('student.appointments')->with('success', 'Appointment booked successfully.');
    }

    /**
     * Mark an appointment as received (for counselors).
     */
    public function receive(Appointment $appointment)
    {
        if (Auth::user()->role !== 'counselor') {
            abort(403, 'Unauthorized access.');
        }

        StatusHistory::create([
            'appointment_id' => $appointment->id,
            'status' => 'received',
        ]);

        return redirect()->route('student.appointments')->with('success', 'Appointment received.');
    }

    /**
     * Mark an appointment as completed (for counselors).
     */
    public function complete(Appointment $appointment)
    {
        if (Auth::user()->role !== 'counselor') {
            abort(403, 'Unauthorized access.');
        }

        $appointment->update(['status' => 'past']);
        StatusHistory::create([
            'appointment_id' => $appointment->id,
            'status' => 'completed',
        ]);

        return redirect()->route('student.appointments')->with('success', 'Appointment completed.');
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('student.appointments.show', compact('appointment'));
    }

    /**
     * Remove the specified appointment (cancel).
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $appointment->update(['status' => 'cancelled']);
        StatusHistory::create([
            'appointment_id' => $appointment->id,
            'status' => 'cancelled',
        ]);

        return redirect()->route('student.appointments')->with('success', 'Appointment cancelled successfully.');
    }
}
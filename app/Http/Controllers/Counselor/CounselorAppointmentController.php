<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CounselorAppointmentController extends Controller
{
    public function index()
    {
        $counselorId = auth()->id();
        $appointments = Appointment::with('user')
            ->where('counselor_id', $counselorId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('counselor.appointment', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:upcoming,cancelled'
        ]);

        // Ensure the appointment belongs to the counselor
        if ($appointment->counselor_id !== auth()->id()) {
            return redirect()->route('counselor.appointment')->with('error', 'Unauthorized action.');
        }

        $appointment->update([
            'status' => $request->status
        ]);

        $message = $request->status === 'upcoming' ? 'Appointment accepted successfully.' : 'Appointment rejected successfully.';
        return redirect()->route('counselor.appointment')->with('success', $message);
    }

    public function reschedule(Request $request, Appointment $appointment)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required'
        ]);

        // Ensure the appointment belongs to the counselor
        if ($appointment->counselor_id !== auth()->id()) {
            return redirect()->route('counselor.appointment')->with('error', 'Unauthorized action.');
        }

        $appointment->update([
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'upcoming' // Set to upcoming after rescheduling
        ]);

        return redirect()->route('counselor.appointment')->with('success', 'Appointment rescheduled successfully.');
    }
}
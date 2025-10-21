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
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->user->avatar_url = getUserAvatarUrl($appointment->user);
        }

        return view('counselor.appointment', compact('appointments'));
    }


    public function updateStatus(Request $request, Appointment $appointment)
    {
        \Log::info('updateStatus called', ['appointment_id' => $appointment->id, 'status' => $request->status]);
        $request->validate([
            'status' => 'required|in:upcoming,cancelled'
        ]);

        if ($appointment->counselor_id !== auth()->id()) {
            \Log::warning('Unauthorized action for appointment: ' . $appointment->id);
            return redirect()->route('counselor.appointment')->with('error', 'Unauthorized action.');
        }

        $appointment->update(['status' => $request->status]);
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





    public function dashboard()
    {
        $totalAppointments = Appointment::count();
        $completedSessions = Session::where('status', 'completed')->count();
        $pendingSessions = Session::where('status', 'pending')->count();
        $newStudents = User::where('role', 'student')->where('created_at', '>=', now()->subMonth())->count();

        // Example percentage change (replace with your logic)
        $appointmentChange = rand(-10, 10); // Simulate change
        $completedChange = rand(-10, 10);
        $pendingChange = rand(-10, 10);
        $studentsChange = rand(-10, 10);

        return view('counselor.dashboard', compact(
            'totalAppointments',
            'completedSessions',
            'pendingSessions',
            'newStudents',
            'appointmentChange',
            'completedChange',
            'pendingChange',
            'studentsChange'
        ));
    }
}
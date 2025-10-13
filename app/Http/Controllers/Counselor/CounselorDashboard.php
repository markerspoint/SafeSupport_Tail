<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class CounselorDashboard extends Controller
{
    public function dashboard()
    {
        $counselorId = auth()->id(); // integer ID

        $totalAppointments = Appointment::where('counselor_id', $counselorId)->count();
        $completedSessions = Appointment::where('counselor_id', $counselorId)
                                        ->where('status', 'past')
                                        ->count();
        $pendingSessions = Appointment::where('counselor_id', $counselorId)
                                      ->where('status', 'upcoming')
                                      ->count();
        $cancelledSessions = Appointment::where('counselor_id', $counselorId)
                                        ->where('status', 'cancelled')
                                        ->count();

        // Recent appointments (last 5)
        $recentAppointments = Appointment::with('user')
            ->where('counselor_id', $counselorId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->take(5)
            ->get();

        // Monthly appointments for chart (last 6 months)
        $monthlyLabels = [];
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');
            $monthlyData[] = Appointment::where('counselor_id', $counselorId)
                ->whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->count();
        }

        // Session Completion for bar chart
        $sessionCompletion = [
            'labels' => ['Upcoming', 'Past', 'Cancelled'],
            'data' => [
                $pendingSessions,   // upcoming
                $completedSessions, // past
                $cancelledSessions  // cancelled
            ]
        ];

        return view('counselor.dashboard', compact(
            'totalAppointments',
            'completedSessions',
            'pendingSessions',
            'cancelledSessions',
            'recentAppointments',
            'monthlyLabels',
            'monthlyData',
            'sessionCompletion'
        ));
    }
}
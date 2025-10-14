<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;

class CounselorDashboard extends Controller
{
    public function dashboard()
    {
        $counselorId = auth()->id();

        // Current month data
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();

        $totalAppointments = Appointment::where('counselor_id', $counselorId)->count();
        $completedSessions = Appointment::where('counselor_id', $counselorId)
                                       ->where('status', 'past')
                                       ->count();
        $pendingSessions = Appointment::where('counselor_id', $counselorId)
                                     ->where('status', 'pending')
                                     ->count();
        $upcomingSessions = Appointment::where('counselor_id', $counselorId)
                                      ->where('status', 'upcoming')
                                      ->count();
        $cancelledSessions = Appointment::where('counselor_id', $counselorId)
                                       ->where('status', 'cancelled')
                                       ->count();

        // Percentage change calculations
        $prevTotalAppointments = Appointment::where('counselor_id', $counselorId)
                                          ->where('date', '<', $currentMonth)
                                          ->where('date', '>=', $previousMonth)
                                          ->count();
        $appointmentChange = $prevTotalAppointments > 0 ? (($totalAppointments - $prevTotalAppointments) / $prevTotalAppointments) * 100 : 0;

        $prevCompletedSessions = Appointment::where('counselor_id', $counselorId)
                                          ->where('status', 'past')
                                          ->where('date', '<', $currentMonth)
                                          ->where('date', '>=', $previousMonth)
                                          ->count();
        $completedChange = $prevCompletedSessions > 0 ? (($completedSessions - $prevCompletedSessions) / $prevCompletedSessions) * 100 : 0;

        $prevPendingSessions = Appointment::where('counselor_id', $counselorId)
                                        ->where('status', 'pending')
                                        ->where('date', '<', $currentMonth)
                                        ->where('date', '>=', $previousMonth)
                                        ->count();
        $pendingChange = $prevPendingSessions > 0 ? (($pendingSessions - $prevPendingSessions) / $prevPendingSessions) * 100 : 0;

        $prevUpcomingSessions = Appointment::where('counselor_id', $counselorId)
                                         ->where('status', 'upcoming')
                                         ->where('date', '<', $currentMonth)
                                         ->where('date', '>=', $previousMonth)
                                         ->count();
        $upcomingChange = $prevUpcomingSessions > 0 ? (($upcomingSessions - $prevUpcomingSessions) / $prevUpcomingSessions) * 100 : 0;

        $prevCancelledSessions = Appointment::where('counselor_id', $counselorId)
                                          ->where('status', 'cancelled')
                                          ->where('date', '<', $currentMonth)
                                          ->where('date', '>=', $previousMonth)
                                          ->count();
        $cancelledChange = $prevCancelledSessions > 0 ? (($cancelledSessions - $prevCancelledSessions) / $prevCancelledSessions) * 100 : 0;

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

        // Weekly appointments for chart (last 6 weeks)
        $weeklyLabels = [];
        $weeklyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();
            $weeklyLabels[] = $weekStart->format('d M') . ' - ' . $weekEnd->format('d M');
            $weeklyData[] = Appointment::where('counselor_id', $counselorId)
                ->whereBetween('date', [$weekStart, $weekEnd])
                ->count();
        }

        // Session Completion for bar chart
        $sessionCompletion = [
            'labels' => ['Past', 'Cancelled', 'Upcoming', 'Pending'],
            'data' => [
                $completedSessions,
                $cancelledSessions,
                $upcomingSessions,
                $pendingSessions
            ]
        ];

        return view('counselor.dashboard', compact(
            'totalAppointments',
            'completedSessions',
            'pendingSessions',
            'cancelledSessions',
            'upcomingSessions',
            'recentAppointments',
            'monthlyLabels',
            'monthlyData',
            'weeklyLabels', // Added
            'weeklyData',   // Added
            'sessionCompletion',
            'appointmentChange',
            'completedChange',
            'pendingChange',
            'cancelledChange',
            'upcomingChange'
        ));
    }
}
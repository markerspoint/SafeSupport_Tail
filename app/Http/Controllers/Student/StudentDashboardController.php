<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon; // Make sure this is imported

class StudentDashboardController extends Controller
{
    public function index()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        $monday = Carbon::now()->startOfWeek(); // Monday of current week
        $sunday = Carbon::now()->endOfWeek();   // Sunday of current week

        // Fetch schedules for current week, grouped by day
        $weeklySchedules = Schedule::whereBetween('start', [$monday, $sunday])
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->start)->format('l'); // Group by day name
            });

        // Pass variables to the view
        return view('student.dashboard', [
            'days' => $days,
            'weeklySchedules' => $weeklySchedules
        ]);
    }
}

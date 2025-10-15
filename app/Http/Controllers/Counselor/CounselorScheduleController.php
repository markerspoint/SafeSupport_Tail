<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CounselorScheduleController extends Controller
{
    public function index()
    {
        return view('counselor.schedule');
    }

    public function fetch(Request $request)
    {
        \Log::info('Fetch schedules called', [
            'start' => $request->query('start'),
            'end' => $request->query('end'),
            'user_id' => Auth::id(),
        ]);

        if (!Auth::check()) {
            \Log::error('User not authenticated for /counselor/schedules');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $start = $request->query('start')
                ? Carbon::parse($request->query('start'))->startOfDay()
                : now()->startOfWeek();
            $end = $request->query('end')
                ? Carbon::parse($request->query('end'))->endOfDay()
                : now()->endOfWeek();

            $schedules = Schedule::where('user_id', Auth::id())
                ->where('start', '>=', $start)
                ->where('end', '<=', $end)
                ->get(['id', 'title', 'start', 'end'])
                ->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'title' => $schedule->title,
                        'start' => $schedule->start->toIso8601String(),
                        'end' => $schedule->end->toIso8601String(),
                    ];
                });

            \Log::info('Schedules fetched', ['count' => $schedules->count()]);
            return response()->json($schedules);
        } catch (\Exception $e) {
            \Log::error('Error fetching schedules: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $schedule = Schedule::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'start' => Carbon::parse($request->start),
            'end' => Carbon::parse($request->end),
        ]);

        return response()->json([
            'id' => $schedule->id,
            'title' => $schedule->title,
            'start' => $schedule->start->toIso8601String(),
            'end' => $schedule->end->toIso8601String(),
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        \Log::info('Update schedule called', [
            'schedule_id' => $schedule->id,
            'user_id' => Auth::id(),
            'input' => $request->all(),
        ]);

        $this->authorize('update', $schedule);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $schedule->update([
            'title' => $request->title ?? $schedule->title,
            'start' => Carbon::parse($request->start),
            'end' => Carbon::parse($request->end),
        ]);

        \Log::info('Schedule updated', ['schedule_id' => $schedule->id]);

        return response()->json([
            'id' => $schedule->id,
            'title' => $schedule->title,
            'start' => $schedule->start->toIso8601String(),
            'end' => $schedule->end->toIso8601String(),
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        $schedule->delete();
        return response()->json(['success' => true]);
    }
}
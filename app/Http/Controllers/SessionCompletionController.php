<?php

namespace App\Http\Controllers;

use App\Models\CompletedSession;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SessionCompletionController extends Controller
{
    public function index()
    {
        $tutor = auth()->user();

        // Fetch upcoming schedules for the tutor that are not completed
        $schedules = Schedule::with(['lesson', 'student', 'completedSession'])
            ->where('tutor_id', $tutor->username)
            ->whereDoesntHave('completedSession')
            ->latest()
            ->get();

        // Fetch completed sessions for the tutor
        $completedSessions = CompletedSession::with(['schedule.lesson', 'schedule.student'])
            ->whereHas('schedule', function($query) use ($tutor) {
                $query->where('tutor_id', $tutor->username);
            })
            ->latest()
            ->get();

        // Pass both variables to the view
        return view('schedule', [
            'schedules' => $schedules,
            'completedSessions' => $completedSessions
        ]);
    }

    public function markSessionAsDone($scheduleId)
    {
        // Validate the schedule belongs to the authenticated tutor
        $schedule = Schedule::where('id', $scheduleId)
            ->where('tutor_id', auth()->user()->username)
            ->firstOrFail();

        // Check if the current date is less than the booking date
        if (Carbon::parse($schedule->booking_date)->gt(now())) {
            return back()->with('error', 'This session is not done yet!');
        }

        // Check if the session is already completed
        if ($schedule->completedSession()->exists()) {
            return back()->with('error', 'This session has already been marked as completed.');
        }

        // Create a new completed session
        CompletedSession::create([
            'schedule_id' => $scheduleId,
            'completed_date' => now()->toDateString(), // Optional notes from the form
            'status' => ('done')
        ]);

        // Redirect back with success message
        return back()->with('success', 'Session marked as completed successfully.');
    }

    public function markAsDone($scheduleId)
    {
        // Find the schedule
        $schedule = Schedule::findOrFail($scheduleId);

        // Check if the session belongs to the authenticated student
        if ($schedule->student_id !== auth()->user()->username) {
            return redirect()->back()->with('error', 'You are not authorized to mark this session as done.');
        }

        // Check if the session date is in the past or today
//        $sessionDate = Carbon::parse($schedule->booking_date);
//        $today = Carbon::today();
//
//        if ($sessionDate->greaterThan($today)) {
//            return redirect()->back()->with('error', 'You cannot mark a future session as done.');
//        }

        // Check if the completed session exists for this schedule
        $existingCompletedSession = CompletedSession::where('schedule_id', $scheduleId)->first();

        // If the completed session doesn't exist in the completed_sessions table
        if (!$existingCompletedSession) {
            return redirect()->back()->with('error', 'This session is not yet done!');
        }

        if ($schedule->id == $existingCompletedSession->schedule_id) {
            return redirect()->back()->with('error', 'This session has already been marked as completed.');
        }

        // Fetch completed sessions for the student

        return redirect()->back()->with('success', 'Session marked as completed.');
    }
}

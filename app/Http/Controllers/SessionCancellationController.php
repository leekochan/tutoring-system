<?php

namespace App\Http\Controllers;

use App\Models\CancelledSession;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionCancellationController extends Controller
{
    public function cancel($scheduleId)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the schedule
            $schedule = Schedule::findOrFail($scheduleId);

            // Create a cancelled session record
            $cancelledSession = CancelledSession::create([
                'original_schedule_id' => $schedule->id,
                'lesson_id' => $schedule->lesson_id,
                'tutor_id' => $schedule->tutor_id,
                'student_id' => $schedule->student_id,
                'booking_date' => $schedule->booking_date,
                'morning_session_hours' => $schedule->morning_session_hours,
                'morning_session_time' => $schedule->morning_session_time,
                'afternoon_session_hours' => $schedule->afternoon_session_hours,
                'afternoon_session_time' => $schedule->afternoon_session_time,
                'total_session_duration' => $schedule->total_session_duration,
                'session_number' => $schedule->session_number,
                'booking_method' => $schedule->booking_method
            ]);

            // Delete the original schedule
            $schedule->delete();

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->route('student/schedule')->with('success', 'Session cancelled successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            // Redirect back with error message
            return redirect()->route('student/schedule')->with('error', 'Failed to cancel the session.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonBookingController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'session_duration' => 'required|in:1.0,1.5,2.0,2.5,3.0',
            'booking_dates' => 'required|array|min:1',
            'booking_times' => 'required|array',
        ]);

        $booking = [];
        foreach ($validated['booking_dates'] as $index => $date) {
            $sessionNumber = $index + 1;

            // Check if the combination of lesson_id and session_number already exists
            $existingSchedule = DB::table('schedules')
                ->where('lesson_id', $lesson->id)
                ->where('session_number', $sessionNumber)
                ->first();

            if ($existingSchedule) {
                return redirect()->back()->withErrors(['error' => 'A session with this number already exists for this lesson.']);
            }

            $booking[] = Schedule::create([
                'lesson_id' => $lesson->id,
                'tutor_id' => $lesson->tutor->username,
                'student_id' => auth()->user()->username,
                'booking_date' => $date,
                'booking_time' => $validated['booking_times'][$sessionNumber],
                'session_duration' => $validated['session_duration'],
                'session_number' => $sessionNumber,
            ]);
        }

        return redirect()->route('student/schedule')->with('success', 'Lesson booked successfully');
    }
}

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
        $bookingMethod = $request->input('booking_method');

        // Validate booking date
//        if ($request->input('one_day_date') === null) {
//            return redirect()->back()->withErrors(['one_day_date' => 'Booking date is required.']);
//        }
//
//        // Check for existing booking
//        $existingBooking = Schedule::where('lesson_id', $lesson->id)
//            ->where('student_id', auth()->user()->username)
//            ->first();
//
//        if ($existingBooking) {
//            return redirect()->back()->withErrors(['lesson_id' => 'You have already booked this lesson. Please update the existing booking.']);
//        }

        if ($bookingMethod === 'one_day') {
            $morningSessionHours = (float)$request->input('morning_session', 0);
            $afternoonSessionHours = (float)$request->input('afternoon_session', 0);

            $booking = Schedule::create([
                'lesson_id' => $lesson->id,
                'tutor_id' => $lesson->tutor->username,
                'student_id' => auth()->user()->username,
                'booking_date' => $request->input('one_day_date'),
                'morning_session_hours' => $morningSessionHours,
                'morning_session_time' => $this->getTimeSlotLabel($morningSessionHours, 'morning'),
                'afternoon_session_hours' => $afternoonSessionHours,
                'afternoon_session_time' => $this->getTimeSlotLabel($afternoonSessionHours, 'afternoon'),
                'total_session_duration' => $morningSessionHours + $afternoonSessionHours,
                'session_number' => 1,
                'booking_method' => 'one_day',
                'status' => 'pending'
            ]);
        } else {
            $bookings = [];
            $sessionDates = $request->input('session_dates', []);
            $morningSessions = $request->input('morning_sessions', []);
            $afternoonSessions = $request->input('afternoon_sessions', []);

            foreach ($sessionDates as $index => $date) {
                $morningSessionHours = (float)($morningSessions[$index] ?? 0);
                $afternoonSessionHours = (float)($afternoonSessions[$index] ?? 0);

                $bookings[] = Schedule::create([
                    'lesson_id' => $lesson->id,
                    'tutor_id' => $lesson->tutor->username,
                    'student_id' => auth()->user()->username,
                    'booking_date' => $date,
                    'morning_session_hours' => $morningSessionHours,
                    'morning_session_time' => $this->getTimeSlotLabel($morningSessionHours, 'morning'),
                    'afternoon_session_hours' => $afternoonSessionHours,
                    'afternoon_session_time' => $this->getTimeSlotLabel($afternoonSessionHours, 'afternoon'),
                    'total_session_duration' => $morningSessionHours + $afternoonSessionHours,
                    'session_number' => $index + 1,
                    'booking_method' => 'multiple_sessions',
                    'status' => 'pending'
                ]);
            }
        }

        return redirect()->route('student/schedule')->with('success', 'Lesson booked successfully');
    }

// Helper method to get time slot label
    private function getTimeSlotLabel($hours, $sessionType)
    {
        $timeSlots = $sessionType === 'morning' ?
            [
                1 => '8:00am - 9:00am',
                2 => '8:00am - 10:00am',
                3 => '8:00am - 11:00am',
                4 => '8:00am - 12:00pm'
            ] :
            [
                1 => '1:00pm - 2:00pm',
                2 => '1:00pm - 3:00pm',
                3 => '1:00pm - 4:00pm',
                4 => '1:00pm - 5:00pm'
            ];

        return $timeSlots[$hours] ?? null;
    }
}

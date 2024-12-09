<?php

use App\Http\Controllers\LessonBookingController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionCancellationController;
use App\Http\Controllers\SessionCompletionController;
use App\Models\Lesson;
use App\Models\Schedule;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('land');
});
Route::get('/login', function () {
    return view('login');
});


// Tutor Dashboard
Route::get('/dashboard', function () {
    $tutor = auth()->user();
    return view('dashboard', [
        'lessons' => Lesson::where('lesson_tutor', $tutor->username)->latest()->get()
    ]);
})->middleware(['auth', 'role:tutor', 'tutor'])->name('dashboard');

Route::get('/schedule', [SessionCompletionController::class, 'index'])
    ->middleware(['auth', 'role:tutor', 'tutor'])
    ->name('schedule');

Route::post('/mark-session-done/{scheduleId}', [SessionCompletionController::class, 'markSessionAsDone'])
    ->name('mark.session.done');

Route::get('/completed-sessions', [SessionCompletionController::class, 'getCompletedSessions'])
    ->name('completed.sessions');




// Student Dashboard
Route::get('student/dashboard', function () {
    $student = auth()->user();
    $lessons = Lesson::take(3)->latest()->get();

    return view('student-dashboard', ['lessons' => $lessons,
        'schedules' => Schedule::where('student_id', $student->username)->take(3)->latest()->get()]);
})->middleware(['auth', 'student'])->name('student/dashboard');

Route::get('/topics', function () {
    $lessons = Lesson::latest()->get();

    return view('student-topics', ['lessons' => $lessons]);
})->middleware(['auth', 'student'])->name('/topics');

Route::get('lesson/{id}/book', function ($id) {
    $lesson = Lesson::find($id);

    return view('booking', ['lesson' => $lesson]);
})->middleware(['auth', 'student'])->name('book');

Route::get('student/schedule' , function () {
    $student = auth()->user();
    return view('student-schedule', [
        'schedules' => Schedule::where('student_id', $student->username)->latest()->get()
    ]);
})->middleware(['auth', 'student'])->name('student/schedule');

Route::delete('/session/{scheduleId}/cancel', [SessionCancellationController::class, 'cancel'])
    ->middleware(['auth', 'student'])
    ->name('session.cancel');

Route::post('/booking/{lesson}', [LessonBookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{lesson}', [LessonBookingController::class, 'store'])->name('booking.store');

Route::view('/student-schedule', 'student-schedule')->name('student-schedule');

Route::view('/lesson/create', 'create-lesson');
Route::post('/lesson/create', [LessonController::class, 'lessonCreate']);

Route::get('/lesson/{id}/edit', [LessonController::class, 'edit']);
Route::patch('/lesson/{id}', [LessonController::class, 'update']);
Route::delete('/lesson/{id}', [LessonController::class, 'delete']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

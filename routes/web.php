<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Tutor Dashboard
Route::get('/dashboard', function () {
    $tutor = auth()->user();
    return view('dashboard', [
        'lessons' => Lesson::where('lesson_tutor', $tutor->username)->latest()->get()
    ]);
})->middleware(['auth', 'role:tutor'])->name('dashboard');




// Student Dashboard
Route::get('student/dashboard', function () {
    $lessons = Lesson::take(3)->get();

    return view('student-dashboard', ['lessons' => $lessons]);
})->middleware(['auth', 'role:student'])->name('student/dashboard');

Route::get('/topics', function () {
    $lessons = Lesson::all();

    return view('student-topics', ['lessons' => $lessons]);
});

Route::get('lesson/{id}/book', function ($id) {
    $lesson = Lesson::find($id);

    return view('booking', ['lesson' => $lesson]);
});

Route::get('student/schedule' , function () {

    return view('student-schedule');
});

Route::view('/schedule', 'schedule')->name('schedule');
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

<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    $tutor = auth()->user();

    return view('dashboard', [
        'lessons' => $tutor ? Lesson::where('lesson_tutor', $tutor->username)->latest()->get() : collect([])
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/schedule', 'schedule')->name('schedule');

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

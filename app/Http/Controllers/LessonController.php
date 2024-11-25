<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function edit(Lesson $id)
    {
        return view('lesson-edit', ['lesson' => $id]);
    }

    public function update(Lesson $id)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required', 'max:200',
            'price' => 'required',
            'duration' => 'required',
            'topics' => 'required',
        ]);

        $id->update([
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
            'duration' => request('duration'),
            'topics' => request('topics'),
        ]);

        return redirect('/dashboard');
    }

    public function delete(Lesson $id)
    {
        $id->delete();

        return redirect('/dashboard');
    }

    public function lessonCreate()
    {
        $user = Auth::user();

        Lesson::create([
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
            'lesson_tutor' => $user->username,
            'duration' => request('duration'),
            'topics' => request('topics'),
        ]);

        return redirect('/dashboard');
    }
}

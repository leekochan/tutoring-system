<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function semanticSearch(Request $request)
    {
        $query = $request->input('search', '');

        // If query is empty, return all lessons
        if (empty($query)) {
            $lessons = Lesson::latest()->get();
        } else {
            // Perform semantic search
            $lessons = $this->openAIService->searchLessons($query);
        }

        return view('student-topics', ['lessons' => $lessons]);
    }

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

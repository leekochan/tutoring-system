<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $guarded = [];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'username');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'username');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}

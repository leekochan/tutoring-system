<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $guarded = [];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'lesson_tutor', 'username');
    }
}

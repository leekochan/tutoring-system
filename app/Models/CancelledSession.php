<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelledSession extends Model
{
    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'username');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'username');
    }
}

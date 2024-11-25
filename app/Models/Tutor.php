<?php

namespace App\Models;

use Database\Factories\TutorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    /** @use HasFactory<TutorFactory> */
    use HasFactory;

    protected $primaryKey = 'tutor_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'username');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'lesson_tutor', 'tutor_id');
    }
}

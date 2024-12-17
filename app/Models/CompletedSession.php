<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedSession extends Model
{
    protected  $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}

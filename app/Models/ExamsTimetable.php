<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class ExamsTimetable extends Model
{
     protected $guarded = ['id'];

public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }     //
}

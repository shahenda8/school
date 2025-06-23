<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Teacher;
use App\Models\ExamsTimetable;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id'];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }

public function exams()
{
    return $this->hasMany(Exam::class);
}

public function examTimetables()
{
    return $this->hasMany(ExamsTimetable::class);
}


    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
}

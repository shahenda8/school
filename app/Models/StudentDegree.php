<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentDegree extends Model
{
    protected $guarded = ['id'];

    public function student()
{
    return $this->belongsTo(Student::class);
}

public function exam()
{
    return $this->belongsTo(Exam::class);
}
}

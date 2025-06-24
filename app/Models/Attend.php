<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'teacher_id', 'student_id', 'subject_id', 'class_model_id', 'date', 'status'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function classModel() {
        return $this->belongsTo(ClassModel::class, 'class_model_id');
    }
}

<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Homework;
use App\Models\TimeTable;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $guarded = ['id'];

    public function students(){
         return $this->hasMany(Student::class);
    }

    public function homeworks(){
         return $this->hasMany(Homework::class);
    }

    public function teachers(){
         return $this->belongsToMany(Teacher::class,'class_teachers');
    }

    public function timeTables(){
         return $this->hasOne(TimeTable::class,'class_model_id', 'id');
    }
}

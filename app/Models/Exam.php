<?php

namespace App\Models;

use App\Models\Question;
use App\Models\StudentDegree;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = ['id'];

public function degrees()
{
    return $this->hasMany(StudentDegree::class);
}

 public function questions()
{
    return $this->hasMany(Question::class);
}


}

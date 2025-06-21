<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Guardian;
use App\Models\ClassModel;
use App\Models\StudentDegree;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function classModel(){
        return $this->belongsTo(ClassModel::class, 'class_models_id', 'id');
    }

    public function gardian(){
        return $this->belongsTo(Guardian::class, 'guardian_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
   }

   public function degrees()
{
    return $this->hasMany(StudentDegree::class);
}


}

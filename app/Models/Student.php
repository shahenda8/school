<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function classModel(){
        return $this->belongsTo(ClassModel::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
   }


}

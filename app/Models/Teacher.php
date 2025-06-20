<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\ClassModel;
use PhpParser\Builder\Class_;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = ['id'];

    public function classModel(){
        return $this->belongsToMany(ClassModel::class,'time_table');
   }

   public function comments(){
    return $this->hasMany(Comment::class);
}

public function stage(){
    return $this->belongsTo(Stage::class);
}

public function subject(){
    return $this->belongsTo(Subject::class);
}


}

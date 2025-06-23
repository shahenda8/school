<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Comment;
use App\Models\Subject;
use App\Models\ClassModel;
use PhpParser\Builder\Class_;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher  extends Authenticatable
{
    protected $guarded = ['id'];
 protected $guard = 'teacher';

  protected $hidden = [
        'password',
    ];
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

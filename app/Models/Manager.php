<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $guarded = ['id'];

    public function comments(){
        return $this->hasMany(Comment::class);
   }

}

<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable {
    protected $guarded = ['id'];
 protected $guard = 'manager';

   protected $hidden = [
        'password',
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
   }

}

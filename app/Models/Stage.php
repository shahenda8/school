<?php

namespace App\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $guarded = ['id'];

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
}

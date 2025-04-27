<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $guarded = ['id'];

    public function classModel(){
        return $this->belongsTo(ClassModel::class);
    }
}

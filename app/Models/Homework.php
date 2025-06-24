<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $guarded = ['id'];

    public function classModel(){
        return $this->belongsTo(ClassModel::class);
    }
    public function Subject()
{
    return $this->belongsTo(Subject::class);
}

}

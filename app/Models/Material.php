<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = ['id'];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
}

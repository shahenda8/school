<?php

namespace App\Models;

use App\Models\Question;
use App\Models\StudentDegree;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = ['id'];

public function degrees()
{
    return $this->hasMany(StudentDegree::class);
}

 public function questions()
{
    return $this->hasMany(ExamQuestion::class);
}
 public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
public function class_model(){
        return $this->belongsTo(ClassModel::class,'class_model_id');
    }
    
    public function getDegreeAttribute(){
        $total=0;
        foreach($this->questions as $question){
            $total+=$question->question->degree;
        }
        return $total;
    }

}

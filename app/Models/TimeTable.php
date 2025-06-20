<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassModel;
use Mockery\Matcher\Subset;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $guarded = ['id'];
    protected $table = 'time_table';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class);
    }
}

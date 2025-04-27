<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

}

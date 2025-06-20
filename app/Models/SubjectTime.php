<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTime extends Model
{
    protected $guarded = ['id'];

    public function timeTable()
    {
        return $this->hasMany(TimeTable::class);
    }

}

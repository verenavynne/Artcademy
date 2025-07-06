<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseWeek extends Model
{
    protected $table='course_weeks';

    protected $fillable=['courseId','weekName'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function materis(){
        return $this->hasMany(CourseMateri::class,'weekId');
    }
}

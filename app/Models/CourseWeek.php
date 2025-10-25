<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseWeek extends Model
{
    protected $table='course_weeks';

    protected $fillable=['courseId','tutorId', 'weekName'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function tutor()
    {
        return $this->belongsTo(CourseLecturer::class, 'tutorId');
    }

    public function materials(){
        return $this->hasMany(CourseMateri::class,'weekId');
    }

    public function progress(){
        return $this->hasMany(StudentWeekProgress::class,'weekId');
    }
}

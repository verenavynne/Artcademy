<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLecturer extends Model
{
    protected $table='course_lecturers';

    protected $fillable=['lecturerId','courseId'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function lecturer(){
        return $this->belongsTo(Lecturer::class,'lecturerId');
    }

    public function zooms()
    {
        return $this->hasMany(Zoom::class, 'tutorId');
    }

    public function weeks(){
        return $this->hasMany(CourseWeek::class,'tutorId');
    }
}

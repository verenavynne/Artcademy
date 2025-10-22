<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table='courses';

    protected $fillable=['courseName','courseText','coursePicture','courseLevel', 'courseType', 'coursePaymentType', 'courseDurationInMinutes', 'courseReview', 'bookmarked'];

    public function weeks(){
        return $this->hasMany(CourseWeek::class,'courseId');
    }

    public function courseLecturers(){
        return $this->hasMany(CourseLecturer::class,'courseId');
    }

    public function courseEnrollments(){
        return $this->hasMany(CourseEnrollment::class,'courseId');
    }

    public function certificate(){
        return $this->hasOne(Certificate::class,'courseId');
    }

    public function zoom(){
        return $this->hasMany(Zoom::class,'courseId');
    }

    public function project(){
        return $this->hasOne(Project::class,'courseId');
    }

}

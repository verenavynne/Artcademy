<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    protected $table='course_enrollments';

    protected $fillable=['courseId','studentId','status','startDate','endDate'];

    public function course(){
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }
}

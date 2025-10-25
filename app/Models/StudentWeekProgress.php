<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentWeekProgress extends Model
{
    protected $table = 'student_week_progress';

    protected $fillable = [
        'courseEnrollmentId',
        'weekId',
        'progress',
        'status'
    ];

    public function week(){
        return $this->belongsTo(CourseWeek::class, 'weekId');
    }

    public function courseEnrollment(){
        return $this->belongsTo(CourseEnrollment::class, 'courseEnrollmentId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMateriProgress extends Model
{
    protected $table = 'student_materi_progress';

    protected $fillable = [
        'courseEnrollmentId',
        'materiId',
        'isDone',
    ];

    public function materi(){
        return $this->belongsTo(CourseMateri::class, 'materiId');
    }

    public function courseEnrollment(){
        return $this->belongsTo(CourseEnrollment::class, 'courseEnrollmentId');
    }
}

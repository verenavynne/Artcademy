<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerProjectComment extends Model
{
    protected $table='lecturer_project_comment';

    protected $fillable=['courseLecturerId','projectSubmissionId','comment'];

    public function courseLecturer()
    {
        return $this->belongsTo(CourseLecturer::class, 'courseLecturerId');
    }

    public function projectSubmission()
    {
        return $this->belongsTo(ProjectSubmission::class, 'projectSubmissionId');
    }
}

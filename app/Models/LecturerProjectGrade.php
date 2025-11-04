<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerProjectGrade extends Model
{
    protected $table='lecturer_project_grades';

    protected $fillable=['courseLecturerId','projectSubmissionId','projectCriteriaId','score'];

    public function courseLecturer()
    {
        return $this->belongsTo(CourseLecturer::class, 'courseLecturerId');
    }

    public function projectSubmission()
    {
        return $this->belongsTo(ProjectSubmission::class, 'projectSubmissionId');
    }

    public function projectCriteria()
    {
        return $this->belongsTo(ProjectCriteria::class, 'projectCriteriaId');
    }
}

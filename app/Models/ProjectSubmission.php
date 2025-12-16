<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $table='project_submissions';

    protected $fillable=['projectId','studentId','projectSubmissionName','projectSubmissionLink','projectSubmissionThumbnail','projectSubmissionDesc','projectSubmissionDate','deadlineSubmission', 'gradingDeadline','status','grade'];

    protected $casts = [
        'deadlineSubmission' => 'datetime',
        'projectSubmissionDate' => 'datetime',
        'gradingDeadline' => 'datetime',
    ];

    public function project(){
        return $this->belongsTo(Project::class,'projectId');

    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function lecturerGrades()
    {
        return $this->hasMany(LecturerProjectGrade::class, 'projectSubmissionId');
    }

    public function lecturerComments()
    {
        return $this->hasMany(LecturerProjectComment::class, 'projectSubmissionId');
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'reference', 'referenceType', 'referenceId');
    }
}

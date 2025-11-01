<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $table='project_submissions';

    protected $fillable=['projectId','studentId','projectSubmissionName','projectSubmissionLink','projectSubmissionThumbnail','projectSubmissionDesc','projectSubmissionDate','status','grade'];

    // projectSubmissionDate -> date student kumpul project
    // deadlineSubmission -> deadline student harus kumpul project

    public function project(){
        return $this->belongsTo(Project::class,'projectId');

    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }
}

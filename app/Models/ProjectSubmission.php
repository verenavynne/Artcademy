<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $table='project_submissions';

    protected $fillable=['projectId','studentId','date','status','grade'];

    public function project(){
        return $this->belongsTo(Project::class,'projectId');

    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='projects';

    protected $fillable=['courseId','projectName','projectConcept','projectRequirement'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function projectSubmissions(){
        return $this->hasMany(ProjectSubmission::class,'projectId');
    }

    public function projectTools(){
        return $this->hasMany(ProjectTool::class,'projectId');
    }

    public function projectCriterias(){
        return $this->hasMany(ProjectCriteria::class,'projectId');
    }
}

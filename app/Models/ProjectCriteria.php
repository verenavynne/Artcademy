<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCriteria extends Model
{
    protected $table='project_criteria';

    protected $fillable=['projectId','criteriaId','customWeight'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectId');
    }

    public function criteria()
    {
        return $this->belongsTo(GradeCriteria::class, 'criteriaId');
    }

    public function lecturerGrades()
    {
        return $this->hasMany(LecturerProjectGrade::class, 'projectCriteriaId');
    }

}

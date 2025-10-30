<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeCriteria extends Model
{
    protected $table='grade_criteria';

    protected $fillable=['criteriaName','criteriaWeight'];

    public function projectCriteria(){
        return $this->hasMany(ProjectCriteria::class, 'criteriaId');
    }
    
    public function projects(){
        return $this->hasMany(Project::class,'criteriaId');
    }
}

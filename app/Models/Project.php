<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='projects';

    protected $fillable=['courseId','projectName','projectDesc'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function projectSubmissions(){
        return $this->hasMany(ProjectSubmission::class,'projectId');
    }
}

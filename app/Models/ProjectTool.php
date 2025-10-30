<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTool extends Model
{
    protected $table='project_tools';

    protected $fillable=['projectId','toolId'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectId');
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'toolId');
    }
}

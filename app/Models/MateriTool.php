<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriTool extends Model
{
    protected $table='materi_tools';

    protected $fillable=['materiId','toolId'];

    public function materi()
    {
        return $this->belongsTo(CourseMateri::class, 'materiId');
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'toolId');
    }
}

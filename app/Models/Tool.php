<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table='tools';

    protected $fillable=['toolsName','toolsPicture','toolsType'];

    public function materials(){
        return $this->hasMany(MateriTool::class,'toolId');
    }

    public function projects(){
        return $this->hasMany(Project::class,'toolId');
    }
}

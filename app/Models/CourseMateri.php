<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMateri extends Model
{
    protected $table='course_materis';

    protected $fillable=['weekId','materiName','articleName','articleText','vblName','vblDesc','vblUrl','duration'];

    public function week(){
        return $this->belongsTo(CourseWeek::class,'weekId');
    }

    public function materiTools(){
        return $this->hasMany(MateriTool::class,'materiId');
    }

    public function progress(){
        return $this->hasMany(StudentMateriProgress::class,'materiId');
    }
}

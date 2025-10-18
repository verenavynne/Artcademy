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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table='zooms';

    protected $fillable=['courseId','tutorId','zoomName','zoomDate','zoomLink'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function tutor()
    {
        return $this->belongsTo(CourseLecturer::class, 'tutorId');
    }

    public function zoomRegistereds(){
        return $this->hasMany(ZoomRegistered::class,'zoomId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table='zooms';

    protected $fillable=['courseId','tutorId','zoomName','zoomDesc','zoomLink','zoomDuration','zoomQuota','zoomDate','start_time', 'end_time'];

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

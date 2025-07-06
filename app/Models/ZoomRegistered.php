<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoomRegistered extends Model
{
    protected $table='zoom_registereds';

    protected $fillable=['zoomId','studentId'];

    public function zoom(){
        return $this->belongsTo(Zoom::class,'zoomId');
    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }
}

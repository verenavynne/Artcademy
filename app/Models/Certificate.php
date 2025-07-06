<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table='certificates';

    protected $fillable=['courseId','certificateUrl'];

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }

    public function studentCertificate(){
        return $this->hasMany(StudentsCertificate::class,'certificateId');
    }
}

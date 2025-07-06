<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsCertificate extends Model
{
    protected $table='student_certificates';

    protected $fillable=['certificateId','studentId','date'];

    public function certificate(){
        return $this->belongsTo(Certificate::class,'certificateId');
    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }
}

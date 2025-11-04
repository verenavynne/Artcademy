<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsCertificate extends Model
{
    protected $table='students_certificates';

    protected $fillable=['studentId','courseId','issuedDate','pdfPath'];

    protected $casts = [
        'issuedDate' => 'date',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function course(){
        return $this->belongsTo(Course::class,'courseId');
    }
}

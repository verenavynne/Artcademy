<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table='testimonis';
    protected $fillable = ['courseId','studentId','rating','testimoniContent'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentId');
    }
}

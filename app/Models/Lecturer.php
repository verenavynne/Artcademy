<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{

    protected $table='lecturers';

    protected $fillable = ['id', 'specialization'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id'); 
    }

    public function courseLecturer(){
        return $this->hasMany(CourseLecturer::class,'lecturerId');
    }
}

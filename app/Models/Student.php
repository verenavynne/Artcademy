<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table='students';
    protected $fillable = ['id'];

    // TODO: bisa tambah data baru kalau dibutuhkan nanti
    // protected $fillable=[''];

    public function user()
    {
        return $this->belongsTo(User::class, 'id'); 
    }

    public function courseEnrollments(){
        return $this->hasMany(CourseEnrollment::class,'studentId');
    }

    public function studentCertificates(){
        return $this->hasMany(StudentsCertificate::class,'studentId');
    }

    public function zoomRegistereds(){
        return $this->hasMany(ZoomRegistered::class,'studentId');
    }

    public function projectSubmissions(){
        return $this->hasMany(ProjectSubmission::class,'studentId');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'paymentId');
    }

    public function membershipTransactions(){
        return $this->hasMany(MembershipTransaction::class,'studentId');
    }

    public function eventTransaction(){
        return $this->hasMany(EventTransaction::class,'studentId');
    }
}

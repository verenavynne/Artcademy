<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table='payments';

    protected $fillable=['studentId','price','paymentMethod','paymentStatus','midtransTokenId'];

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function membershipTransaction(){
        return $this->hasOne(MembershipTransaction::class,'paymentId');
    }

    public function eventTransaction(){
        return $this->hasOne(EventTransaction::class,'paymentId');
    }
}

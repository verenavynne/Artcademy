<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    protected $table='membership_transactions';

    protected $fillable=['membershipId','studentId','paymentId','startDate','endDate','membershipStatus'];

    public function membership(){
        return $this->belongsTo(Membership::class,'membershipId');
    }

    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'paymentId');
    }
}

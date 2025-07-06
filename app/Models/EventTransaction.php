<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTransaction extends Model
{
    protected $table='event_transactions';

    protected $fillable=['eventId','studentId','paymentId','date'];

    public function event(){
        return $this->belongsTo(Event::class,'eventId');
    }
    public function student(){
        return $this->belongsTo(Student::class,'studentId');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'paymentId');
    }

}

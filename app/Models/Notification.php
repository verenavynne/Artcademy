<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notificiations';

    protected $fillable =['userId', 'actorId', 'notificationMessage', 'notificationDate', 'referenceType', 'referenceId', 'status'];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function actor(){
        return $this->belongsTo(User::class, 'actorId');
    }

    public function reference(){
        return $this->morphTo(null, 'referenceType', 'referenceId');
    }


}

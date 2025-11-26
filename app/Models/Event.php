<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table='events';

    protected $fillable=['eventCategory', 'eventName','eventDesc','eventDate','eventDuration', 'start_time', 'eventPlace','eventPrice','eventSlot', 'eventBanner'];

    public function eventTransaction(){
        return $this->hasMany(EventTransaction::class,'eventId');
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'reference', 'referenceType', 'referenceId');
    }

}

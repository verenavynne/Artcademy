<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table='events';

    protected $fillable=['eventName','eventDesc','eventDate','eventPlace','eventPrice','eventSlot'];

    public function eventTransaction(){
        return $this->hasMany(EventTransaction::class,'eventId');
    }

}

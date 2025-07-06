<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table='chatbots';

    protected $fillable=['chatbotName','chatbotMascot'];
    
    public function comments(){
        return $this->hasMany(Comment::class,'chatbotId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    protected $fillable=['postId','userId','chatbotId','commentText','commentDate','commentContent','commentBy'];

    public function post(){
        return $this->belongsTo(Post::class,'postId');
    }

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    public function chatbot(){
        return $this->belongsTo(Chatbot::class,'chatbotId');
    }
}

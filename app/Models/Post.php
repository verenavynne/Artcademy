<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';

    protected $fillable=['userId','postText','postDate','postContent','triggerChatbot'];

    public function comments(){
        return $this->hasMany(Comment::class,'postId');
    }

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }
}

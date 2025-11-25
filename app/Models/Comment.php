<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    protected $fillable=['postId','userId','chatbotId','parentId','commentText','commentDate','commentBy'];

    public function post(){
        return $this->belongsTo(Post::class,'postId');
    }

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    public function chatbot(){
        return $this->belongsTo(Chatbot::class,'chatbotId');
    }

    public function files(){
        return $this->hasMany(CommentFile::class,'commentId');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parentId');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parentId');
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'reference', 'referenceType', 'referenceId');
    }

}

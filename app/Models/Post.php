<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';

    protected $fillable=['userId','postText','postDate','triggerChatbot'];

    protected $casts = [
        'postDate' => 'datetime',
        'triggerChatbot' => 'boolean',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId')
                    ->whereNull('parentId')
                    ->orderBy('created_at');
    }

    public function allComments(){
        return $this->hasMany(Comment::class,'postId');
    }

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    public function files(){
        return $this->hasMany(PostFile::class, 'postId');
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'reference', 'referenceType', 'referenceId');
    }
}

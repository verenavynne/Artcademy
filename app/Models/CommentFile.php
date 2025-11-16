<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentFile extends Model
{
    protected $table='comment_files';

    protected $fillable=['commentId','filePath','fileType'];

    public function comment(){
        return $this->belongsTo(Comment::class,'commentId');
    }
}

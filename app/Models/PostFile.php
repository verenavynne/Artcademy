<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    protected $table='post_files';

    protected $fillable=['postId','filePath','fileType'];

    public function post(){
        return $this->belongsTo(Post::class, 'postId');
    }
}

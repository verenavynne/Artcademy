<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $posts = Post::with(['user', 'files', 'allComments.user', 'comments.files', 'comments.replies.user', 'comments.replies.files'])
        ->orderBy('created_at', 'desc')
        ->get();

        $otherProfile = User::where('id', '!=', $user->id)->get();
        return view('forum.forum', compact('user', 'posts', 'otherProfile'));
    }
}

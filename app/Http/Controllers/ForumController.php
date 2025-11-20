<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Portfolio;
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

    public function showFriendProfile($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $portfolios = Portfolio::where('userId', $user->id)->get();
        $posts = Post::where('userId', $user->id)->get();
        $otherProfile = User::where('id', '!=', auth()->id())->get();
        $activeTab = request('tab', 'portfolio');

        return view('forum.kunjungi-profile', compact('user', 'portfolios','posts', 'otherProfile', 'activeTab'));
    }
}

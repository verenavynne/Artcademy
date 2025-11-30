<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\User;
use App\Models\MembershipTransaction;
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

        $otherProfile = User::where('id', '!=', $user->id)
            ->where('role', '!=', 'admin')->get();

        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('forum.forum', compact('user', 'posts', 'otherProfile', 'membershipTransaction', 'membershipStatus'));
    }

    public function showFriendProfile($id)
    {
        $authUser = Auth::user();
        $user = User::with('lecturer')->where('id', $id)->firstOrFail();
        $portfolios = Portfolio::where('userId', $user->id)->get();
        $posts = Post::where('userId', $user->id)->get();
        $otherProfile = User::where('id', '!=', auth()->id())->where('role', '!=', 'admin')->get();
        $activeTab = request('tab', 'portfolio');

        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('forum.kunjungi-profile', compact('user', 'authUser', 'portfolios','posts', 'otherProfile', 'activeTab', 'membershipTransaction', 'membershipStatus'));
    }
}

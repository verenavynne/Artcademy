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
    public function show(Request $request)
    {
        $user = Auth::user();
        $query = $request->query('query');
        $totalPost = Post::count();
        $posts = Post::with(['user', 'files', 'allComments.user', 'comments.files', 'comments.replies.user', 'comments.replies.files'])
        ->when($query, function($q) use ($query){
            $q->where(function($post) use ($query){
                $post->where('postText', 'like', "%{$query}%")

                ->orWhereHas('comments', function($comment) use ($query) {
                    $comment->where('commentText', 'like', "%{$query}%");
                })

                ->orWhereHas('comments.replies', function($reply) use ($query) {
                    $reply->where('commentText', 'like', "%{$query}%");
                });
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

        $otherProfile = User::where('id', '!=', $user->id)
            ->where('role', '!=', 'admin')->get();

        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('forum.forum', compact('user', 'totalPost','posts', 'otherProfile', 'membershipTransaction', 'membershipStatus'));
    }

    public function showFriendProfile($id)
    {
        $authUser = Auth::user();
        $selectedUser = User::with('lecturer')->where('id', $id)->firstOrFail();
        $portfolios = Portfolio::where('userId', $selectedUser->id)->get();
        $posts = Post::where('userId', $selectedUser->id)->get();
        $otherProfile = User::where('id', '!=', auth()->id())->where('role', '!=', 'admin')->get();
        $activeTab = request('tab', 'portofolio');

        $selectedUserMembershipTransaction = MembershipTransaction::where('studentId', $selectedUser->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipTransaction = MembershipTransaction::where('studentId', $authUser->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $selectedUserMembershipStatus = $selectedUserMembershipTransaction?->membershipStatus ?? 'belum berlangganan';

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('forum.kunjungi-profile', compact('selectedUser', 'authUser', 'portfolios','posts', 'otherProfile', 'activeTab', 'selectedUserMembershipTransaction', 'selectedUserMembershipStatus', 'membershipStatus', 'membershipTransaction'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'postId' => 'required|exists:posts,id',
            'caption' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:4096',
            'videos.*' => 'mimetypes:video/mp4|max:20000',
        ], [
            'caption.required' => 'Konten wajib diisi',
            'images.*.mimes' => 'Foto hanya boleh berformat JPG, JPEG, PNG.',
            'videos.*.mimes' => 'Video hanya boleh berformat mp4.'
        ]);

        $comment = Comment::create([
            'postId' => $request->postId,
            'userId' => auth()->id(),
            'commentText' => $request->caption,
            'commentDate' => now(),
            'commentBy' => 'user',
            'parentId' => $request->parentId ?? null,   // buat reply thread
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('comment_files', 's3');

                CommentFile::create([
                    'commentId' => $comment->id,
                    'filePath' => $path,
                    'fileType' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('comment_files', 's3');

                CommentFile::create([
                    'commentId' => $comment->id,
                    'filePath' => $path,
                    'fileType' => 'video',
                ]);
            }
        }

        $postOwnerId = Post::find($request->postId)->userId;
        $this->createNotification($postOwnerId, auth()->id(), 'post', $comment->id);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function addCommentReply(Request $request)
    {
        $request->validate([
            'postId' => 'required|exists:posts,id',
            'parentId' => 'required|exists:comments,id',
            'caption' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:4096',
            'videos.*' => 'mimetypes:video/mp4|max:20000',
        ], [
            'caption.required' => 'Konten wajib diisi',
            'images.*.mimes' => 'Foto hanya boleh berformat JPG, JPEG, PNG.',
            'videos.*.mimes' => 'Video hanya boleh berformat mp4.'
        ]);

        $reply = Comment::create([
            'postId' => $request->postId,
            'userId' => auth()->id(),
            'commentText' => $request->caption,
            'commentDate' => now(),
            'commentBy' => 'user',
            'parentId' => $request->parentId, 
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('comment_files', 's3');

                CommentFile::create([
                    'commentId' => $reply->id,
                    'filePath' => $path,
                    'fileType' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('comment_files', 's3');

                CommentFile::create([
                    'commentId' => $reply->id,
                    'filePath' => $path,
                    'fileType' => 'video',
                ]);
            }
        }

        $parentComment = Comment::find($request->parentId);
        $commentOwnerId = $parentComment?->userId;

        if ($commentOwnerId && $commentOwnerId !== auth()->id()) {
            $this->createNotification(
                $commentOwnerId,
                auth()->id(),
                'comment',
                $reply->id
            );
        }

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    private function createNotification(int $userId, int $actorId, string $referenceType, int $referenceId){
        if($actorId === $userId){
            return;
        }

        $notificationMessage = null;
        $actorName = User::find($actorId)->name ?? 'Seseorang';

        if($referenceType === 'post'){
            $notificationMessage = "{$actorName} mengomentari postingan kamu";
        }else if($referenceType === 'comment'){
            $notificationMessage = "{$actorName} membalas komentar kamu";
        };

        Notification::create([
            'userId' => $userId,
            'actorId' => $actorId,
            'notificationMessage' => $notificationMessage,
            'notificationDate' => now(),
            'referenceType' => $referenceType,
            'referenceId' => $referenceId,
            'status' => 'unread',
        ]);
    }
}

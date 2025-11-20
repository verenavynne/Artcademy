<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentFile;
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
            'caption.required' => 'Isi konten wajib diisi',
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
                $path = $img->store('comment_files', 'public');

                CommentFile::create([
                    'commentId' => $comment->id,
                    'filePath' => $path,
                    'fileType' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('comment_files', 'public');

                CommentFile::create([
                    'commentId' => $comment->id,
                    'filePath' => $path,
                    'fileType' => 'video',
                ]);
            }
        }

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
            'caption.required' => 'Isi konten wajib diisi',
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
                $path = $img->store('comment_files', 'public');

                CommentFile::create([
                    'commentId' => $reply->id,
                    'filePath' => $path,
                    'fileType' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('comment_files', 'public');

                CommentFile::create([
                    'commentId' => $reply->id,
                    'filePath' => $path,
                    'fileType' => 'video',
                ]);
            }
        }

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}

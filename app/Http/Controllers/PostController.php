<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostFile;
use App\Services\ChatbotService;
use Illuminate\Http\Request;
use Storage;

class PostController extends Controller
{
    public function addPost(Request $request, ChatbotService $chatbot)
    {
        $request->validate([
            'caption' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:4096',
            'videos.*' => 'mimetypes:video/mp4|max:20000',
        ], [
            'caption.required' => 'Isi konten wajib diisi',
            'images.*.mimes' => 'Foto hanya boleh berformat JPG, JPEG, PNG.',
            'videos.*.mimes' => 'Video hanya boleh berformat mp4.'
        ]);

        $trigger = $request->has('triggerChatbot') ? 1 : 0;

        $post = Post::create([
            'userId' => auth()->id(),
            'postText' => $request->caption,
            'postDate' => now(),
            'triggerChatbot' => $trigger,
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('post_files', 'public');

                PostFile::create([
                    'postId' => $post->id,
                    'filePath' => $path,
                    'fileType' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('post_files', 'public');

                PostFile::create([
                    'postId' => $post->id,
                    'filePath' => $path,
                    'fileType' => 'video',
                ]);
            }
        }

        $chatbotComment = null;
        $reply = null;

        if ($trigger === 1) {
            $reply = $chatbot->generateReply($post->postText);

            if ($reply) {
                $chatbotComment = Comment::create([
                    'postId'      => $post->id,
                    'chatbotId'   => 1,
                    'userId'      => null,
                    'parentId'    => null,
                    'commentText' => $reply,
                    'commentDate' => now(),
                    'commentBy'   => 'chatbot'
                ]);
            }
            return redirect()->back()->with('chatbot_comment_id', $chatbotComment->id);
        }

        return redirect()->back()->with('success', 'Post berhasil dibuat!');
    }

    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();

        return redirect()->back()->with('success', 'Post berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->deleted_files) {
            $deleted = json_decode($request->deleted_files, true);

            foreach ($deleted as $fileId) {
                $file = PostFile::where('id',$fileId)->where('postId', $id)->first();
                if ($file) {
                    Storage::delete($file->filePath); 
                    $file->delete(); 
                }
            }
        }

        $post->update([
            'postText' => $request->caption,
            'triggerChatbot' => $request->has('triggerChatbot'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('post_files','public');
                PostFile::create([
                    'postId' => $post->id,
                    'filePath' => $path,
                    'fileType' => 'image'
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $vid) {
                $path = $vid->store('post_files','public');
                PostFile::create([
                    'postId' => $post->id,
                    'filePath' => $path,
                    'fileType' => 'video'
                ]);
            }
        }

        return back()->with('success', 'Post berhasil diperbarui!');
    }

}

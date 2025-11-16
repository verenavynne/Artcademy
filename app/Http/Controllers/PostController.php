<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addPost(Request $request)
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

        return redirect()->back()->with('success', 'Post berhasil dibuat!');
    }
}

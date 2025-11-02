<?php

namespace App\Http\Controllers;

use App\Models\ProjectSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProjectSubmissionController extends Controller
{
    public function submitProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => ['required', 'regex:/^(https?:\/\/|www\.)[^\s]+$/'],
            'thumbnail' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'Judul projek wajib diisi.',
            'link.required' => 'Link projek wajib diisi.',
            'link.regex' => 'Link harus diawali dengan https://, http://, atau www.',
            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.mimes' => 'Thumbnail hanya boleh berformat JPG, JPEG, atau PNG.',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('project_thumbnails', 'public');

        ProjectSubmission::create([
            'projectId' => $request->input('projectId'), // pastikan dikirim dari form hidden input
            'studentId' => Auth::id(), // ambil dari user yang login
            'projectSubmissionName' => $request->input('title'),
            'projectSubmissionLink' => $request->input('link'),
            'projectSubmissionThumbnail' => $thumbnailPath,
            'projectSubmissionDesc' => $request->input('description'),
            'projectSubmissionDate' => Carbon::now(),
            'deadlineSubmission' => Carbon::now()->addWeek(),
            'status' => 'not_graded',
            'grade' => null,
        ]);

        return redirect()->back()->with('success', 'Projek berhasil dikumpulkan!');
    }
}

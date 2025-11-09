<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function addPortfolio(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'link' => ['required', 'regex:/^(https?:\/\/|www\.)[^\s]+$/'],
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4',
            'description' => 'nullable|string',
            'mockupType' => 'required|in:laptop,mobile'
        ], [
            'name.required' => 'Judul portofolio wajib diisi.',
            'link.required' => 'Link portofolio wajib diisi.',
            'link.regex' => 'Link harus diawali dengan https://, http://, atau www.',
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'File hanya boleh berformat JPG, JPEG, PNG, atau mp4.',
            'mockupType.required' => 'Tipe mockup wajib dipilih.',
            'mockupType.in' => 'Tipe mockup tidak valid. Harus salah satu: laptop atau mobile.'
        ]);

        $studentId = Auth::id();

        $filePath = $request->file('file')->store('portfolio_mediaPath', 'public');

        Portfolio::create([
            'userId' => $studentId,
            'portfolioName' => $request->input('name'),
            'portfolioDesc' => $request->input('description'),
            'portfolioLink' => $request->input('link'),
            'portfolioPath' => $filePath,
            'mockupType' => $request->input('mockupType')
        ]);


        return redirect()->route('my-profile')->with('success', 'Portofolio berhasil ditambahkan!');

    }
}

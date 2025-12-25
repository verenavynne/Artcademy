<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\ProjectSubmission;
use App\Models\MembershipTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function addPortfolioBtn(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'lecturer') {
            return view('profile.add-portfolio');
        }

        $portfolioCount = Portfolio::where('userId', $user->id)->count();

        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        if (!$membershipTransaction || !$membershipTransaction->membership) {
            return redirect()->back()
                ->with('show_membership_modal', true)
                ->with('modal_message', 'Kamu belum memiliki membership aktif. Silakan berlangganan untuk menambahkan portofolio.');
        }

        $allowedPortfolios = match ($membershipTransaction->membership->membershipName) {
            'Basic Canvas' => 5,
            'Creative Studio' => 10,
            'Masterpiece Pro' => PHP_INT_MAX,
            default => 0,
        };

        if ($portfolioCount >= $allowedPortfolios) {
            return redirect()->back()
                ->with('show_membership_modal', true)
                ->with('modal_message', 'Batas unggah portofolio kamu sudah mencapai maksimum untuk membership ini. Silakan upgrade membership');
        }

        return view('profile.add-portfolio');
    }

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
        
        $originalName = $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('portfolio_mediaPath', $originalName, 's3');

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

    public function editPortfolio($id)
    {
        $portfolio = Portfolio::where('id', $id)->firstOrFail();

        return view('profile.edit-portfolio', compact('portfolio'));
    }

    public function updatePortfolio(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => ['required', 'regex:/^(https?:\/\/|www\.)[^\s]+$/'],
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4',
            'description' => 'nullable|string',
            'mockupType' => 'required|in:laptop,mobile'
        ], [
            'name.required' => 'Judul portofolio wajib diisi.',
            'link.required' => 'Link portofolio wajib diisi.',
            'link.regex' => 'Link harus diawali dengan https://, http://, atau www.',
            'mockupType.required' => 'Tipe mockup wajib dipilih.',
            'mockupType.in' => 'Tipe mockup tidak valid. Harus salah satu: laptop atau mobile.'
        ]);

        $portfolio = Portfolio::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($portfolio->portfolioPath && Storage::disk('s3')->exists($portfolio->portfolioPath)) {
                Storage::disk('s3')->delete($portfolio->portfolioPath);
            }

            $originalName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('portfolio_mediaPath', $originalName, 's3');

            $portfolio->update([
                'portfolioName' => $request->name,
                'portfolioDesc' => $request->description,
                'portfolioLink' => $request->link,
                'mockupType' => $request->mockupType,
                'portfolioPath' => $filePath
            ]);
        }else{
            $portfolio->update([
                'portfolioName' => $request->name,
                'portfolioDesc' => $request->description,
                'portfolioLink' => $request->link,
                'mockupType' => $request->mockupType
            ]);

        }


        return redirect()->route('my-profile')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function addFromProject($id)
    {
        $submission = ProjectSubmission::findOrFail($id);

        $studentId = Auth::id();

        if (Portfolio::where('portfolioLink', $submission->projectSubmissionLink)->where('userId', $studentId)->exists()) {
            return redirect()->back()->with('info', 'Projek ini sudah ada di portofolio kamu.');
        }

        Portfolio::create([
            'userId' => $studentId,
            'portfolioName' => $submission->projectSubmissionName,
            'portfolioDesc' => $submission->projectSubmissionDesc,
            'portfolioLink' => $submission->projectSubmissionLink,
            'portfolioPath' => $submission->projectSubmissionThumbnail,
            'mockupType' => 'laptop' 
        ]);

        return redirect()->back()->with('success', 'Projek berhasil dimasukkan ke portofolio!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('id', $id)->firstOrFail();
        $portfolio->delete();
      
        return redirect()->back()->with('success', 'Portofolio berhasil dihapus!');
    }

}

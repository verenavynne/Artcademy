<?php

namespace App\Http\Controllers;

use App\Models\CourseEnrollment;
use App\Models\Portfolio;
use App\Models\ProjectSubmission;
use App\Models\StudentWeekProgress;
use App\Models\User;
use App\Models\ZoomRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $portfolios = Portfolio::where('userId', $user->id)->get();

        if ($user->role === 'student') {
            $layout = 'layouts.master';
        } elseif ($user->role === 'lecturer') {
            $layout = 'layouts.master-tutor';
        }

        return view('profile.my-profile', compact('user', 'portfolios', 'layout'));

    }

    public function showMyCourses()
    {
        $user = Auth::user();
        $ongoingCoursesEnrollment = CourseEnrollment::where('studentId', $user->id)
        ->where('status', 'ongoing')
        ->get()
        ->map(function($enrollment) {
            $totalWeeks = $enrollment->course->weeks->count();

            $weekProgressList = StudentWeekProgress::where('courseEnrollmentId', $enrollment->id)->get();

            $sumProgress = $weekProgressList->sum('progress');

            if ($totalWeeks > 0) {
                $progress = round(($sumProgress / ($totalWeeks * 100)) * 100);
            } else {
                $progress = 0;
            }

            $isProjectSubmitted = ProjectSubmission::where('projectId', $enrollment->course->project->id)
                ->where('studentId', $enrollment->studentId)
                ->exists();

            if ($progress == 100 && !$isProjectSubmitted) {
                $progress = 80;
            }

            $enrollment->progress = $progress;

            return $enrollment;
        });

        $finishedCoursesEnrollment = CourseEnrollment::where('studentId', $user->id)
        ->where('status','completed')
        ->get()
        ->map(function($enrollment) {
            $enrollment->progress = 100;

            return $enrollment;
        });

        return view('profile.my-courses', compact('ongoingCoursesEnrollment','finishedCoursesEnrollment'));
    }

    public function showMySchedule()
    {
        $user = Auth::user();
        $zooms = ZoomRegistered::where('studentId', $user->id)
        ->get();

        return view('profile.my-schedule', compact('zooms'));
    }

    public function showMyInfo()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $layout = 'layouts.master';
        } elseif ($user->role === 'admin') {
            $layout = 'layouts.master-admin';
        } elseif ($user->role === 'lecturer') {
            $layout = 'layouts.master-tutor';
        }

        return view('profile.my-info', compact('user', 'layout'));
    }

    public function updateProfile(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phoneNumber' => 'required|string|max:20',
            'dob'         => 'nullable|date',
            'gender'      => 'nullable|in:male,female',
            'profession'  => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'phoneNumber.required' => 'Nomor telepon harus diisi'
        ]);

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'dateOfBirth' => $request->dob,
            'gender'      => $request->gender,
            'profession'  => $request->profession,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');

    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profilePicture' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($user->profilePicture && $user->profilePicture !== 'assets/default-profile.jpg') {
            if (Storage::disk('public')->exists($user->profilePicture)) {
                Storage::disk('public')->delete($user->profilePicture);
            }
        }

        $originalName = $request->file('profilePicture')->getClientOriginalName();
        $filePath = $request->file('profilePicture')->storeAs('profile_pictures', $originalName, 'public');

        $user->update([
            'profilePicture' => $filePath
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'min:8'],
            'confirmNewPassword' => ['required', 'same:newPassword'],
        ], [
            'currentPassword.required' => 'Kata sandi saat ini wajib diisi.',
            'newPassword.required' => 'Kata sandi baru wajib diisi.',
            'confirmNewPassword.required' => 'Konfirmasi kata sandi baru wajib diisi.',
            'newPassword.min' => 'Kata sandi baru minimal 8 karakter.',
            'confirmNewPassword.same' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors([
                'currentPassword' => 'Kata sandi saat ini tidak sesuai.',
            ]);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah!');
    }
}

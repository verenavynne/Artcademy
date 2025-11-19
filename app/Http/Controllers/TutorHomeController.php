<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\CourseLecturer;
use App\Models\Zoom;
use App\Models\ProjectSubmission;

class TutorHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalCourses = CourseLecturer::where('lecturerId', $user->id)->count();


        $now = Carbon::now();
        $zoom = Zoom::where('tutorId', $user->id)
            ->whereRaw("CONCAT(zoomDate, ' ', start_time) >= ?", [$now])
            ->orderByRaw("CONCAT(zoomDate, ' ', start_time) ASC")
            ->first();


        $submissions = ProjectSubmission::whereHas('project.course.courseLecturers', function ($q) use ($user) {
            $q->where('lecturerId', $user->id);
        })->take(4)->get();
        

        $hour = now()->timezone('Asia/Jakarta')->hour;
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Sore';
        } else {
            $greeting = 'Malam';
        }

        return view('lecturer.home', compact('user', 'greeting', 'totalCourses', 'zoom', 'submissions'));
    }
}

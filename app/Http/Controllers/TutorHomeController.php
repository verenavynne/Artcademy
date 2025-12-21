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
        $zoom = Zoom::with(['tutor.lecturer.user'])
            ->whereHas('tutor', function ($query) use ($user) {
                $query->where('lecturerId', $user->id);
            })
            ->whereRaw("CONCAT(zoomDate, ' ', start_time) >= ?", [$now])
            ->orderByRaw("CONCAT(zoomDate, ' ', start_time) ASC")
            ->first();


        $authLecturerId = $user->id;
        $submissions = ProjectSubmission::whereHas('project.course.courseLecturers', function ($q) use ($authLecturerId) {
            $q->where('lecturerId', $authLecturerId);
        })
        ->with([
            'student',
            'project.course.courseLecturers',
            'project.projectCriterias.criteria',
            'lecturerGrades' => function ($q) use ($authLecturerId) {
                $q->whereHas('courseLecturer', function ($q2) use ($authLecturerId) {
                    $q2->where('lecturerId', $authLecturerId);
                });
            },
            'lecturerGrades.projectCriteria.criteria'
        ])
        ->get()
        ->map(function ($submission) use ($authLecturerId) {
            $courseLecturerId = $submission->project->course
                ->courseLecturers()
                ->where('lecturerId', $authLecturerId)
                ->value('id');

            $submission->courseLecturerId = $courseLecturerId;

            $submission->isGraded = $submission->lecturerGrades->isNotEmpty();

            return $submission;
        })
        ->filter(fn($submission) => !$submission->isGraded)
        ->take(4); 
        

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

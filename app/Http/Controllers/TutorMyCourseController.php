<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class TutorMyCourseController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'dipublikasikan');
        $lecturerId = Auth::id();

        if ($status === 'dipublikasikan') {
            $courses = Course::with(['courseLecturers.lecturer.user'])
                ->where('courseStatus', 'publikasi')
                ->whereHas('courseLecturers', function ($query) use ($lecturerId) {
                    $query->where('lecturerId', $lecturerId);
                })
                ->get();
        } else {
            $courses = Course::with(['courseLecturers.lecturer.user'])
                ->where('courseStatus', 'arsip')
                ->whereHas('courseLecturers', function ($query) use ($lecturerId) {
                    $query->where('lecturerId', $lecturerId);
                })
                ->get();
        }

        return view('lecturer.kursus-saya.kursus-saya', compact('courses', 'status'));
    }
}

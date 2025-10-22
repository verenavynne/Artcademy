<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseDetailController extends Controller
{
    public function show($id)
    {
        $course = Course::with(['courseLecturers.lecturer.user', 'weeks.materials', 'zooms'])
                        ->findOrFail($id);

        $otherCourses = Course::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(6)
        ->with(['courseLecturers.lecturer.user'])
        ->get();

        return view('Artcademy.course-detail', compact('course','otherCourses'));
    }

    public function store($id)
    {
        $user = Auth::user();

        $existing = CourseEnrollment::where('courseId', $id)
            ->where('studentId', $user->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Kamu sudah terdaftar di kelas ini.');
        }

        CourseEnrollment::create([
            'courseId' => $id,
            'studentId' => $user->id,
            'status' => 'ongoing',
            'startDate' => now(),
            'endDate' => null
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar ke kursus!');
    }
}

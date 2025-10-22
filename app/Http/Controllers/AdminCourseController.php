<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseWeek;
use App\Models\CourseMateri;
use Illuminate\Http\Request;
use App\Models\CourseLecturer;
use App\Models\Lecturer;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('weeks.materis')->get();
        return view('admin.index', compact('courses'));
    }

    public function create()
    {
        $lecturers = Lecturer::with('user')->get(); 
        return view('admin.course-create', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'courseDurationInMinutes' => 'required|integer|min:1',
            'coursePicture' => 'nullable|image',
            'weeks' => 'array',
            'weeks.*.weekName' => 'required|string|max:255',
            'weeks.*.materis' => 'array',
            'weeks.*.materis.*.materiName' => 'required|string|max:255',
            'weeks.*.materis.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materis.*.articleText' => 'nullable|string',
            'weeks.*.materis.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materis.*.vblDesc' => 'nullable|string',
            'weeks.*.materis.*.vblUrl' => 'nullable|string|max:255',
            'lecturers' => 'required|array',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        $course = Course::create([
            'courseName' => $validated['courseName'],
            'courseText' => $validated['courseText'],
            'courseLevel' => $validated['courseLevel'],
            'courseType' => $validated['courseType'],
            'coursePicture' => $request->file('coursePicture') 
                ? $request->file('coursePicture')->store('course_images', 'public')
                : null,
            'coursePaymentType' => $validated['coursePaymentType'],
            'courseDurationInMinutes' => $validated['courseDurationInMinutes'],
        ]);

        foreach($validated['lecturers'] as $lecturerId){
            CourseLecturer::create([
                'courseId' => $course->id,
                'lecturerId' => $lecturerId
            ]);
        }

        if (!empty($validated['weeks'])) {
            foreach ($validated['weeks'] as $weekData) {
                $week = CourseWeek::create([
                    'courseId' => $course->id,
                    'weekName' => $weekData['weekName'],
                ]);

                if (!empty($weekData['materis'])) {
                    foreach ($weekData['materis'] as $materiData) {
                        CourseMateri::create([
                            'weekId' => $week->id,
                            'materiName' => $materiData['materiName'],
                            'articleName' => $materiData['articleName'] ?? null,
                            'articleText' => $materiData['articleText'] ?? null,
                            'vblName' => $materiData['vblName'] ?? null,
                            'vblDesc' => $materiData['vblDesc'] ?? null,
                            'vblUrl' => $materiData['vblUrl'] ?? null,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course berhasil dibuat.');
    }
}
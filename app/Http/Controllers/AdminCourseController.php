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
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->courseStatus == 'publikasi') {
            $query->where('courseStatus', 'publikasi');
        } elseif ($request->courseStatus == 'draft') {
            $query->where('courseStatus', 'draft');
        } elseif ($request->courseStatus == 'arsip') {
            $query->where('courseStatus', 'arsip');
        }

        if ($request->search) {
            $query->where('courseName', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('perPage', 5);

        $courses = $query->orderBy('created_at', 'desc')
                        ->paginate($perPage)
                        ->appends($request->query());
        return view('admin.index', compact('courses'));
    }

    public function create()
    {
        $lecturers = Lecturer::with('user')->get(); 
        return view('admin.courses.create', compact('lecturers'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $lecturers = Lecturer::with('user')->get(); 
        $courseLecturers = CourseLecturer::where('courseId', $id)->pluck('lecturerId')->toArray();

        return view('admin.courses.edit', compact('course', 'lecturers', 'courseLecturers'));
    }

    public function syllabus(Course $course)
    {
        $tempCourse = session('temp_course');

        if (!$tempCourse) {
            return redirect()->route('admin.courses.create')->with('error', 'Isi informasi kursus terlebih dahulu.');
        }

        $courseLecturers = Lecturer::whereIn('id', $tempCourse['lecturers'])->with('user')->get();


        return view('admin.courses.syllabus', [
            'course' => null,
            'tutors' => $courseLecturers,
        ]);
    }

    public function tempStore(Request $request)
    {
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        session(['temp_course' => $validated]);

        return redirect()->route('admin.courses.syllabus');
    }


    public function draftCourseInformation(Request $request)
    {
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        $course = Course::create([
            'courseName' => $validated['courseName'],
            'courseSummary' => $validated['courseSummary'],
            'courseText' => $validated['courseText'],
            'courseLevel' => $validated['courseLevel'],
            'courseType' => $validated['courseType'],
            'coursePaymentType' => $validated['coursePaymentType'],
            'coursePicture' => 'assets/course/course_default_picture.png',
            'courseStatus' => 'draft',
            'courseReview' => 4.9,
        ]);

        foreach($validated['lecturers'] as $lecturerId){
            CourseLecturer::create([
                'courseId' => $course->id,
                'lecturerId' => $lecturerId
            ]);
        }

        return redirect()->route('admin.courses.index');
    }

    public function saveSyllabus(Request $request, Course $course)
    {
        $tempCourse = session('temp_course');

        if (!$tempCourse) {
            return redirect()->route('admin.courses.create')->with('error', 'Data kursus tidak ditemukan di session.');
        }

        $course = Course::create([
            'courseName' => $tempCourse['courseName'],
            'courseSummary' => $tempCourse['courseSummary'],
            'courseText' => $tempCourse['courseText'],
            'courseLevel' => $tempCourse['courseLevel'],
            'courseType' => $tempCourse['courseType'],
            'coursePaymentType' => $tempCourse['coursePaymentType'],
            'coursePicture' => 'assets/course/course_default_picture.png',
            'courseStatus' => 'draft',
            'courseReview' => 4.9,
        ]);

        foreach ($tempCourse['lecturers'] as $lecturerId) {
            CourseLecturer::create([
                'courseId' => $course->id,
                'lecturerId' => $lecturerId
            ]);
        }

        $this->draftSyllabus($request, $course);

        if ($request->action === 'publish') {
            $course->update(['courseStatus' => 'publikasi']);
            return redirect()->route('admin.courses.index')->with('success', 'Course berhasil dipublikasikan.');
        }

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course berhasil disimpan di draft.');
    }

    private function draftSyllabus(Request $request, Course $course)
    {
        $validated = $request->validate([
            'weeks' => 'array',
            'weeks.*.weekName' => 'required|string|max:255',
            'weeks.*.tutorId' => 'required|exists:lecturers,id',
            'weeks.*.materials' => 'array',
            'weeks.*.materials.*.materiName' => 'required|string|max:255',
            'weeks.*.materials.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materials.*.articleText' => 'nullable|string',
            'weeks.*.materials.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materials.*.vblDesc' => 'nullable|string',
            'weeks.*.materials.*.vblUrl' => 'nullable|string|max:255',
        ]);

        $course->weeks()->delete();

        foreach ($validated['weeks'] as $weekData) {
            $week = $course->weeks()->create([
                'weekName' => $weekData['weekName'],
                'tutorId' => $weekData['tutorId'],
            ]);

            if (!empty($weekData['materials'])) {
                foreach ($weekData['materials'] as $materiData) {
                    $week->materials()->create([
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

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        $course->update([
            'courseName' => $validated['courseName'],
            'courseSummary' => $validated['courseSummary'],
            'courseText' => $validated['courseText'],
            'courseLevel' => $validated['courseLevel'],
            'courseType' => $validated['courseType'],
            'coursePaymentType' => $validated['coursePaymentType'],
            'coursePicture' => 'assets/course/course_default_picture.png',
        ]);

        if ($request->has('lecturers')) {
            $course->lecturers()->sync($request->lecturers);
        }

        return redirect()->route('admin.courses.editSyllabus', $course->id)
            ->with('success', 'Informasi kursus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->courseStatus = 'arsip';
        $course->save();

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus berhasil diarsipkan.');
    }

}
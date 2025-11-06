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

    // Create New Course
    public function create()
    {
        $lecturers = Lecturer::with('user')->get(); 
        return view('admin.courses.create', compact('lecturers'));
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
            'lecturers' => 'required|array|size:3',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        session(['temp_course' => $validated]);

        return redirect()->route('admin.courses.syllabus');
    }


    public function draftCourseInformation(Request $request, $redirect = true)
    {
        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array|size:3',
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

        if ($redirect) {
            return redirect()->route('admin.courses.index');
        }

        return $course;
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

    public function draftSyllabus(Request $request, Course $course, $redirect = true)
    {
        $tempCourse = session('temp_course');

        if (!$tempCourse) {
            return redirect()->route('admin.courses.create')->with('error', 'Data kursus tidak ditemukan di session.');
        }

        $request_course = new Request($tempCourse);
        $course = $this->draftCourseInformation($request_course, false);

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

        if ($redirect) {
            return redirect()->route('admin.courses.index');
        }

        return $course;
    }

    public function tempSyllabus(Request $request)
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

        session(['temp_syllabus' => $validated]);

        return redirect()->route('admin.courses.createProject');
    }

    public function createProject()
    {
        return view('admin.courses.project');
    }

    public function saveCourse(Request $request, Course $course)
    {
        $request_syllabus = new Request(session('temp_syllabus'));
        $course = $this->draftSyllabus($request_syllabus, $course, false);


        $validated = $request->validate([
            'projectName' => 'required|string|max:255',
            'projectConcept' => 'required|string',
            'projectRequirements' => 'nullable|string'
        ]);

        $course->project()->updateOrCreate(
            ['courseId' => $course->id],
            [
                'projectName' => $validated['projectName'],
                'projectConcept' => $validated['projectConcept'],
                'projectRequirements' => $validated['projectRequirements']
            ]
        );

        if ($request->action === 'publish') {
            $course->update(['courseStatus' => 'publikasi']);
        }

        return redirect()->route('admin.courses.index');
    }


    // Edit Course
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $lecturers = Lecturer::with('user')->get(); 
        $courseLecturers = CourseLecturer::where('courseId', $id)->pluck('lecturerId')->toArray();

        return view('admin.courses.edit', compact('course', 'lecturers', 'courseLecturers'));
    }

    public function tempUpdateStore(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate([
            'courseName'        => 'required|string|max:255',
            'courseSummary'     => 'required|string|max:255',
            'courseText'        => 'required',
            'courseLevel'       => 'required|in:dasar,menengah,lanjutan',
            'courseType'        => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers'         => 'required|array|size:3',
            'lecturers.*'       => 'exists:lecturers,id',
        ]);

        session(['temp_update_course' => $validated]);

        return redirect()->route('admin.courses.editSyllabus', [ 'courseId' => $course->id]);
    }

    public function updateDraftCourseInformation(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate([
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array|size:3',
            'lecturers.*' => 'exists:lecturers,id',
        ]);

        $course->update([
            'courseName' => $validated['courseName'],
            'courseSummary' => $validated['courseSummary'],
            'courseText' => $validated['courseText'],
            'courseLevel' => $validated['courseLevel'],
            'courseType' => $validated['courseType'],
            'coursePaymentType' => $validated['coursePaymentType'],
        ]);

        $course->courseLecturers()->delete();

        foreach($validated['lecturers'] as $lecturerId){
            CourseLecturer::create([
                'courseId' => $course->id,
                'lecturerId' => $lecturerId
            ]);
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course berhasil diupdate dan disimpan sebagai draft.');
    }

    public function editSyllabus($courseId) 
    {
        $temp_update_course = session('temp_update_course');

        $weeks = CourseWeek::with('materials')
            ->where('courseId', $courseId)
            ->get();

        $tutors = Lecturer::whereIn('id', $temp_update_course['lecturers'])->with('user')->get();

        return view('admin.courses.syllabus-edit', [
            'course' => Course::findOrFail($courseId),
            'weeks' => $weeks,
            'tutors' => $tutors
        ]);
    }

    public function updateDraftSyllabus(Request $request, Course $course)
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

        $course->weeks()->each(function($week){
            $week->materials()->delete();
        });
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

    public function updateSyllabus(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $temp_update_course = session('temp_update_course');

        $course->update([
            'courseName' => $temp_update_course['courseName'],
            'courseSummary' => $temp_update_course['courseSummary'],
            'courseText' => $temp_update_course['courseText'],
            'courseLevel' => $temp_update_course['courseLevel'],
            'courseType' => $temp_update_course['courseType'],
            'coursePaymentType' => $temp_update_course['coursePaymentType'],
        ]);

        $course->courseLecturers()->delete();

        foreach($temp_update_course['lecturers'] as $lecturerId){
            CourseLecturer::create([
                'courseId' => $course->id,
                'lecturerId' => $lecturerId
            ]);
        }

        $this->updateDraftSyllabus($request, $course);

        if ($request->action === 'publish') {
            $course->update(['courseStatus' => 'publikasi']);
            return redirect()->route('admin.courses.index')->with('success', 'Course berhasil dipublikasikan.');
        }

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course berhasil disimpan di draft.');
    }



    // Archive and Delete Course
    public function archive($id)
    {
        $course = Course::findOrFail($id);
        $course->courseStatus = 'arsip';
        $course->save();

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus berhasil diarsipkan.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Kursus berhasil dihapus.');
    }
}
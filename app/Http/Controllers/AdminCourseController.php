<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseWeek;
use App\Models\CourseMateri;
use Illuminate\Http\Request;
use App\Models\CourseLecturer;
use App\Models\Lecturer;
use App\Models\ProjectTool;
use App\Models\ProjectCriteria;
use App\Models\GradeCriteria;
use App\Models\Tool;

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

        $courses = $query->withCount('courseEnrollments')
                        ->orderBy('created_at', 'desc')
                        ->paginate($perPage)
                        ->appends($request->query());
        return view('admin.index', compact('courses'));
    }

    public function home(Request $request)
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
        return view('admin.home', compact('courses'));
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

        $tools = Tool::all();

        return view('admin.courses.syllabus', [
            'course' => null,
            'tutors' => $courseLecturers,
            'tools' => $tools
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
            'weeks.*.materials.*.duration' => 'required|integer',
            'weeks.*.materials.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materials.*.articleText' => 'nullable|string',
            'weeks.*.materials.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materials.*.vblDesc' => 'nullable|string',
            'weeks.*.materials.*.vblUrl' => 'nullable|string|max:255',
            'weeks.*.materials.*.tools' => 'nullable',
        ]);

        $course->weeks()->delete();

        $totalDuration = 0;

        foreach ($validated['weeks'] as $weekData) {

            $courseLecturer = $course->courseLecturers()
                ->where('lecturerId', $weekData['tutorId'])
                ->first();
            
            $week = $course->weeks()->create([
                'weekName' => $weekData['weekName'],
                'tutorId' => $courseLecturer->id,
            ]);

            if (!empty($weekData['materials'])) {
                foreach ($weekData['materials'] as $materiData) {
                    $materi = $week->materials()->create([
                        'duration' => $materiData['duration'],
                        'articleName' => $materiData['articleName'] ?? null,
                        'articleText' => $materiData['articleText'] ?? null,
                        'vblName' => $materiData['vblName'] ?? null,
                        'vblDesc' => $materiData['vblDesc'] ?? null,
                        'vblUrl' => $materiData['vblUrl'] ?? null,
                    ]);

                    $totalDuration += $materiData['duration'];

                    if (!empty($materiData['tools'])) {
                        foreach ($materiData['tools'] as $toolId) {
                            $materi->materiTools()->create([
                                'toolId' => $toolId
                            ]);
                        }
                    }
                }
            }
        }

        $course->update([
            'courseDurationInMinutes' => $totalDuration
        ]);

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
            'weeks.*.materials.*.duration' => 'required|integer',
            'weeks.*.materials.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materials.*.articleText' => 'nullable|string',
            'weeks.*.materials.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materials.*.vblDesc' => 'nullable|string',
            'weeks.*.materials.*.vblUrl' => 'nullable|string|max:255',
            'weeks.*.materials.*.tools' => 'nullable'
        ]);

        session(['temp_syllabus' => $validated]);

        return redirect()->route('admin.courses.createProject');
    }

    public function createProject()
    {
        $tools = Tool::all();
        return view('admin.courses.project', compact('tools'));
    }

    public function saveCourse(Request $request, Course $course)
    {
        $request_syllabus = new Request(session('temp_syllabus'));
        $course = $this->draftSyllabus($request_syllabus, $course, false);


        $validated = $request->validate([
            'projectName' => 'required|string|max:255',
            'projectConcept' => 'required|string',
            'projectRequirement' => 'nullable|string',
            'projectTools' => 'required|array|min:1',
            'projectTools.*' => 'exists:tools,id',
            'criteriaCreativity' => 'required|integer|min:0|max:100',
            'criteriaReadability' => 'required|integer|min:0|max:100',
            'criteriaTheme' => 'required|integer|min:0|max:100',
        ]);

        $totalCriteria = $validated['criteriaCreativity'] + $validated['criteriaReadability'] + $validated['criteriaTheme'];
        if ($totalCriteria !== 100) {
            return back()->withErrors(['criteria' => 'Total persentase kriteria harus 100%.'])->withInput();
        }

        $project = $course->project()->updateOrCreate(
            ['courseId' => $course->id],
            [
                'projectName' => $validated['projectName'],
                'projectConcept' => $validated['projectConcept'],
                'projectRequirement' => $validated['projectRequirement']
            ]
        );

        foreach ($validated['projectTools'] as $toolId) {
            ProjectTool::create([
                'projectId' => $project->id,
                'toolId' => $toolId,
            ]);
        }

        $criteriaList = GradeCriteria::whereIn('criteriaName', [
            'Kreativitas',
            'Keterbacaan',
            'Kesesuaian Tema'
        ])->get()->keyBy('criteriaName');

        ProjectCriteria::create([
            'projectId' => $project->id,
            'criteriaId' => $criteriaList['Kreativitas']->id ?? null,
            'customWeight' => $validated['criteriaCreativity'],
        ]);

        ProjectCriteria::create([
            'projectId' => $project->id,
            'criteriaId' => $criteriaList['Keterbacaan']->id ?? null,
            'customWeight' => $validated['criteriaReadability'],
        ]);

        ProjectCriteria::create([
            'projectId' => $project->id,
            'criteriaId' => $criteriaList['Kesesuaian Tema']->id ?? null,
            'customWeight' => $validated['criteriaTheme'],
        ]);

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

    public function updateDraftCourseInformation(Request $request, $courseId, $redirect = true)
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

        $existing = $course->courseLecturers()->get();
        $newLecturers = $validated['lecturers'];

        foreach ($existing as $index => $lecturer) {
            $lecturer->update([
                'lecturerId' => $newLecturers[$index]
            ]);
        }

        if ($redirect) {
            return redirect()->route('admin.courses.index');
        }

        return $course;
    }

    public function editSyllabus($courseId) 
    {
        $temp_update_course = session('temp_update_course');

        $weeks = CourseWeek::with(['materials.materiTools.tool', 'tutor.lecturer.user'])
            ->where('courseId', $courseId)
            ->get();

        $tutors = Lecturer::whereIn('id', $temp_update_course['lecturers'])->with('user')->get();

        $tools = Tool::all();

        $sessionTutorIds = $temp_update_course['lecturers'] ?? [];

        $tutors = Lecturer::whereIn('id', $sessionTutorIds)->with('user')->get();

        foreach ($weeks as $week) {
            $lecturerId = optional($week->tutor)->lecturerId;

            $week->selectedLecturerId = $lecturerId && in_array($lecturerId, $sessionTutorIds)
                ? $lecturerId
                : null;
        }

        return view('admin.courses.syllabus-edit', [
            'course' => Course::findOrFail($courseId),
            'weeks' => $weeks,
            'tutors' => $tutors,
            'tools' => $tools
        ]);
    }

    public function updateDraftSyllabus(Request $request, $courseId, $redirect = true)
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

        $existing = $course->courseLecturers()->get();
        $newLecturers = $temp_update_course['lecturers'];

        foreach ($existing as $index => $lecturer) {
            $lecturer->update([
                'lecturerId' => $newLecturers[$index]
            ]);
        }

        $validated = $request->validate([
            'weeks' => 'array',
            'weeks.*.weekName' => 'required|string|max:255',
            'weeks.*.tutorId' => 'required|exists:lecturers,id',
            'weeks.*.materials' => 'array',
            'weeks.*.materials.*.duration' => 'required|integer',
            'weeks.*.materials.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materials.*.articleText' => 'nullable|string',
            'weeks.*.materials.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materials.*.vblDesc' => 'nullable|string',
            'weeks.*.materials.*.vblUrl' => 'nullable|string|max:255',
            'weeks.*.materials.*.tools' => 'nullable'
        ]);

        $course->weeks()->each(function($week){
            $week->materials()->delete();
        });
        $course->weeks()->delete();

        $totalDuration = 0;

        foreach ($validated['weeks'] as $weekData) {
            $courseLecturer = $course->courseLecturers()
                ->where('lecturerId', $weekData['tutorId'])
                ->first();

            $week = $course->weeks()->create([
                'weekName' => $weekData['weekName'],
                'tutorId' => $courseLecturer->id,
            ]);

            if (!empty($weekData['materials'])) {
                foreach ($weekData['materials'] as $materiData) {
                    $materi = $week->materials()->create([
                        'duration' => $materiData['duration'],
                        'articleName' => $materiData['articleName'] ?? null,
                        'articleText' => $materiData['articleText'] ?? null,
                        'vblName' => $materiData['vblName'] ?? null,
                        'vblDesc' => $materiData['vblDesc'] ?? null,
                        'vblUrl' => $materiData['vblUrl'] ?? null,
                    ]);

                    $totalDuration += $materiData['duration'];

                    if (!empty($materiData['tools'])) {
                        foreach ($materiData['tools'] as $toolId) {
                            $materi->materiTools()->create([
                                'toolId' => $toolId
                            ]);
                        }
                    }
                }
            }
        }

        $course->update([
            'courseDurationInMinutes' => $totalDuration
        ]);

        if ($redirect) {
            return redirect()->route('admin.courses.index');
        }

        return $course;
    }

    public function tempUpdateSyllabus(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate([
            'weeks' => 'array',
            'weeks.*.weekName' => 'required|string|max:255',
            'weeks.*.tutorId' => 'required|exists:lecturers,id',
            'weeks.*.materials' => 'array',
            'weeks.*.materials.*.duration' => 'required|integer',
            'weeks.*.materials.*.articleName' => 'nullable|string|max:255',
            'weeks.*.materials.*.articleText' => 'nullable|string',
            'weeks.*.materials.*.vblName' => 'nullable|string|max:255',
            'weeks.*.materials.*.vblDesc' => 'nullable|string',
            'weeks.*.materials.*.vblUrl' => 'nullable|string|max:255',
            'weeks.*.materials.*.tools' => 'nullable'
        ]);

        session(['temp_update_syllabus' => $validated]);

        return redirect()->route('admin.courses.editProject', ['courseId' => $course->id]);
    }

    public function editProject($courseId)
    {
        $course = Course::findOrFail($courseId);
        $tools = Tool::all();

        $project = null;
        $selectedTools = [];
        $criteriaWeights = [
            'Kreativitas' => null,
            'Keterbacaan' => null,
            'Kesesuaian Tema' => null,
        ];

        if($course->project()->exists()) {
            $project = $course->project()->first();
            $selectedTools = ProjectTool::where('projectId', $project->id)->pluck('toolId')->toArray();

            $criteriaData = ProjectCriteria::join('grade_criteria', 'project_criteria.criteriaId', '=', 'grade_criteria.id')
                ->where('project_criteria.projectId', $project->id)
                ->select('grade_criteria.criteriaName', 'project_criteria.customWeight')
                ->get();

            $criteriaWeights = [
                'Kreativitas' => optional($criteriaData->firstWhere('criteriaName', 'Kreativitas'))->customWeight,
                'Keterbacaan' => optional($criteriaData->firstWhere('criteriaName', 'Keterbacaan'))->customWeight,
                'Kesesuaian Tema' => optional($criteriaData->firstWhere('criteriaName', 'Kesesuaian Tema'))->customWeight,
            ];
        }


        return view('admin.courses.project-edit', compact('course', 'tools', 'project', 'selectedTools', 'criteriaWeights'));
    }

    public function updateCourse(Request $request, $courseId)
    {
        $request_syllabus = new Request(session('temp_update_syllabus'));
        $course = $this->updateDraftSyllabus($request_syllabus, $courseId, false);
        $project = $course->project;

        $validated = $request->validate([
            'projectName' => 'required|string|max:255',
            'projectConcept' => 'required|string',
            'projectRequirement' => 'nullable|string',
            'projectTools' => 'required|array|min:1',
            'projectTools.*' => 'exists:tools,id',
            'criteriaCreativity' => 'required|integer|min:0|max:100',
            'criteriaReadability' => 'required|integer|min:0|max:100',
            'criteriaTheme' => 'required|integer|min:0|max:100',
        ]);

        $totalCriteria = $validated['criteriaCreativity'] + $validated['criteriaReadability'] + $validated['criteriaTheme'];
        if ($totalCriteria !== 100) {
            return back()->withErrors(['criteria' => 'Total persentase kriteria harus 100%.'])->withInput();
        }

        if ($project) {
            $project->update([
                'projectName' => $validated['projectName'],
                'projectConcept' => $validated['projectConcept'],
                'projectRequirement' => $validated['projectRequirement']
            ]);
        }

        // Dapatkan tools lama dari DB
        $existingTools = $project->projectTools->pluck('toolId')->toArray();
        $newTools = $validated['projectTools'];

        // Tambahkan tools baru
        foreach (array_diff($newTools, $existingTools) as $toolId) {
            ProjectTool::create([
                'projectId' => $project->id,
                'toolId' => $toolId,
            ]);
        }

        // Hapus tools yang sudah tidak dipilih lagi
        ProjectTool::where('projectId', $project->id)
            ->whereIn('toolId', array_diff($existingTools, $newTools))
            ->delete();


        $criteriaList = GradeCriteria::whereIn('criteriaName', [
            'Kreativitas', 'Keterbacaan', 'Kesesuaian Tema'
        ])->get()->keyBy('criteriaName');

        ProjectCriteria::where('projectId', $project->id)
            ->where('criteriaId', $criteriaList['Kreativitas']->id)
            ->update(['customWeight' => $validated['criteriaCreativity']]);

        ProjectCriteria::where('projectId', $project->id)
            ->where('criteriaId', $criteriaList['Keterbacaan']->id)
            ->update(['customWeight' => $validated['criteriaReadability']]);

        ProjectCriteria::where('projectId', $project->id)
            ->where('criteriaId', $criteriaList['Kesesuaian Tema']->id)
            ->update(['customWeight' => $validated['criteriaTheme']]);

        if ($request->action === 'publish') {
            $course->update(['courseStatus' => 'publikasi']);
        } else if ($request->action === 'draft') {
            $course->update(['courseStatus' => 'draft']);
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
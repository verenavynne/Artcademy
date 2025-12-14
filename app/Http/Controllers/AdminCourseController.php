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

        $activeTab = $request->courseStatus ?? 'all';
        return view('admin.index', compact('courses','activeTab'));
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
        $validated = $request->validate(
        [
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array|size:3',
            'lecturers.*' => 'exists:lecturers,id',
        ],
        [
            'courseName.required' => 'Nama course wajib diisi.',
            'courseName.string' => 'Nama course harus berupa teks.',
            'courseName.max' => 'Nama course maksimal 255 karakter.',

            'courseSummary.required' => 'Ringkasan course wajib diisi.',
            'courseSummary.string' => 'Ringkasan course harus berupa teks.',
            'courseSummary.max' => 'Ringkasan course maksimal 255 karakter.',

            'courseText.required' => 'Deskripsi course wajib diisi.',

            'courseLevel.required' => 'Level course wajib dipilih.',
            'courseLevel.in' => 'Level course harus berupa dasar, menengah, atau lanjutan.',

            'courseType.required' => 'Tipe course wajib dipilih.',
            'courseType.in' => 'Tipe course yang dipilih tidak valid.',

            'coursePaymentType.required' => 'Tipe pembayaran course wajib dipilih.',
            'coursePaymentType.in' => 'Tipe pembayaran harus gratis atau berbayar.',

            'lecturers.required' => 'Pengajar wajib dipilih.',
            'lecturers.array' => 'Data pengajar tidak valid.',
            'lecturers.size' => 'Pengajar harus berjumlah tepat 3 orang.',

            'lecturers.*.exists' => 'Pengajar yang dipilih tidak ditemukan.',
        ]
    );

        session(['temp_course' => $validated]);

        return redirect()->route('admin.courses.syllabus');
    }


    public function draftCourseInformation(Request $request, $redirect = true)
    {
        $validated = $request->validate(
        [
            'courseName' => 'required|string|max:255',
            'courseSummary' => 'required|string|max:255',
            'courseText' => 'required',
            'courseLevel' => 'required|in:dasar,menengah,lanjutan',
            'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
            'coursePaymentType' => 'required|in:gratis,berbayar',
            'lecturers' => 'required|array|size:3',
            'lecturers.*' => 'exists:lecturers,id',
        ],
        [
            'courseName.required' => 'Nama kursus wajib diisi.',
            'courseName.string' => 'Nama kursus harus berupa teks.',
            'courseName.max' => 'Nama kursus maksimal 255 karakter.',

            'courseSummary.required' => 'Ringkasan kursus wajib diisi.',
            'courseSummary.string' => 'Ringkasan kursus harus berupa teks.',
            'courseSummary.max' => 'Ringkasan kursus maksimal 255 karakter.',

            'courseText.required' => 'Deskripsi kursus wajib diisi.',

            'courseLevel.required' => 'Level kursus wajib dipilih.',
            'courseLevel.in' => 'Level kursus harus berupa dasar, menengah, atau lanjutan.',

            'courseType.required' => 'Kategori kursus wajib dipilih.',
            'courseType.in' => 'Kategori kursus yang dipilih tidak valid.',

            'coursePaymentType.required' => 'Tipe pembayaran kursus wajib dipilih.',
            'coursePaymentType.in' => 'Tipe pembayaran harus gratis atau berbayar.',

            'lecturers.required' => 'Pengajar wajib dipilih.',
            'lecturers.array' => 'Data pengajar tidak valid.',
            'lecturers.size' => 'Pengajar harus berjumlah tepat 3 orang.',

            'lecturers.*.exists' => 'Pengajar yang dipilih tidak ditemukan.',
        ]
    );

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
            return redirect()->route('admin.courses.index')->with('success', 'Informasi kursus berhasil disimpan draft!');
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
        ],
        [
            'weeks.array' => 'Data minggu kursus tidak valid.',

            'weeks.*.weekName.required' => 'Judul wajib diisi.',
            'weeks.*.weekName.string' => 'Judul harus berupa teks.',
            'weeks.*.weekName.max' => 'Judul maksimal 255 karakter.',

            'weeks.*.tutorId.required' => 'Tutor untuk minggu ini wajib dipilih.',
            'weeks.*.tutorId.exists' => 'Tutor yang dipilih tidak ditemukan.',

            'weeks.*.materials.array' => 'Data materi pada minggu ini tidak valid.',

            'weeks.*.materials.*.duration.required' => 'Durasi materi wajib diisi.',
            'weeks.*.materials.*.duration.integer' => 'Durasi materi harus berupa angka.',

            'weeks.*.materials.*.articleName.string' => 'Judul artikel harus berupa teks.',
            'weeks.*.materials.*.articleName.max' => 'Judul artikel maksimal 255 karakter.',

            'weeks.*.materials.*.articleText.string' => 'Isi artikel harus berupa teks.',

            'weeks.*.materials.*.vblName.string' => 'Judul video harus berupa teks.',
            'weeks.*.materials.*.vblName.max' => 'Judul video maksimal 255 karakter.',

            'weeks.*.materials.*.vblDesc.string' => 'Deskripsi video harus berupa teks.',

            'weeks.*.materials.*.vblUrl.string' => 'URL video harus berupa teks.',
            'weeks.*.materials.*.vblUrl.max' => 'URL video maksimal 255 karakter.',
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
            return redirect()->route('admin.courses.index')->with('success', 'Silabus berhasil disimpan draft!');
        }

        return $course;
    }

    public function tempSyllabus(Request $request)
    {
        $validated = $request->validate(
            [
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
            ],
            [
                'weeks.array' => 'Data minggu kursus tidak valid.',

                'weeks.*.weekName.required' => 'Judul wajib diisi.',
                'weeks.*.weekName.string' => 'Judul harus berupa teks.',
                'weeks.*.weekName.max' => 'Judul maksimal 255 karakter.',

                'weeks.*.tutorId.required' => 'Tutor untuk minggu ini wajib dipilih.',
                'weeks.*.tutorId.exists' => 'Tutor yang dipilih tidak ditemukan.',

                'weeks.*.materials.array' => 'Data materi pada minggu ini tidak valid.',

                'weeks.*.materials.*.duration.required' => 'Durasi materi wajib diisi.',
                'weeks.*.materials.*.duration.integer' => 'Durasi materi harus berupa angka.',

                'weeks.*.materials.*.articleName.string' => 'Judul artikel harus berupa teks.',
                'weeks.*.materials.*.articleName.max' => 'Judul artikel maksimal 255 karakter.',

                'weeks.*.materials.*.articleText.string' => 'Isi artikel harus berupa teks.',

                'weeks.*.materials.*.vblName.string' => 'Judul video harus berupa teks.',
                'weeks.*.materials.*.vblName.max' => 'Judul video maksimal 255 karakter.',

                'weeks.*.materials.*.vblDesc.string' => 'Deskripsi video harus berupa teks.',

                'weeks.*.materials.*.vblUrl.string' => 'URL video harus berupa teks.',
                'weeks.*.materials.*.vblUrl.max' => 'URL video maksimal 255 karakter.',
            ]
        );

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


        $validated = $request->validate(
            [
                'projectName' => 'required|string|max:255',
                'projectConcept' => 'required|string',
                'projectRequirement' => 'nullable|string',
                'projectTools' => 'required|array|min:1',
                'projectTools.*' => 'exists:tools,id',
                'criteriaCreativity' => 'required|integer|min:0|max:100',
                'criteriaReadability' => 'required|integer|min:0|max:100',
                'criteriaTheme' => 'required|integer|min:0|max:100',
            ],
            [
                'projectName.required' => 'Judul projek wajib diisi.',
                'projectName.string' => 'Judul projek harus berupa teks.',
                'projectName.max' => 'Judul projek maksimal 255 karakter.',

                'projectConcept.required' => 'Konsep projek wajib diisi.',
                'projectConcept.string' => 'Konsep projek harus berupa teks.',

                'projectRequirement.string' => 'Persyaratan projek harus berupa teks.',

                'projectTools.required' => 'Minimal satu tools wajib dipilih.',
                'projectTools.array' => 'Data tools tidak valid.',
                'projectTools.min' => 'Minimal satu tools wajib dipilih.',
                'projectTools.*.exists' => 'Tools yang dipilih tidak ditemukan.',

                'criteriaCreativity.required' => 'Nilai kreativitas wajib diisi.',
                'criteriaCreativity.integer' => 'Nilai kreativitas harus berupa angka.',
                'criteriaCreativity.min' => 'Nilai kreativitas minimal 0.',
                'criteriaCreativity.max' => 'Nilai kreativitas maksimal 100.',

                'criteriaReadability.required' => 'Nilai keterbacaan wajib diisi.',
                'criteriaReadability.integer' => 'Nilai keterbacaan harus berupa angka.',
                'criteriaReadability.min' => 'Nilai keterbacaan minimal 0.',
                'criteriaReadability.max' => 'Nilai keterbacaan maksimal 100.',

                'criteriaTheme.required' => 'Nilai kesesuaian tema wajib diisi.',
                'criteriaTheme.integer' => 'Nilai kesesuaian tema harus berupa angka.',
                'criteriaTheme.min' => 'Nilai kesesuaian tema minimal 0.',
                'criteriaTheme.max' => 'Nilai kesesuaian tema maksimal 100.',
            ]
        );

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

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil disimpan!');
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

        $validated = $request->validate(
            [
                'courseName'        => 'required|string|max:255',
                'courseSummary'     => 'required|string|max:255',
                'courseText'        => 'required',
                'courseLevel'       => 'required|in:dasar,menengah,lanjutan',
                'courseType'        => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
                'coursePaymentType' => 'required|in:gratis,berbayar',
                'lecturers'         => 'required|array|size:3',
                'lecturers.*'       => 'exists:lecturers,id',
            ],
            [
                'courseName.required' => 'Nama kursus wajib diisi.',
                'courseName.string' => 'Nama kursus harus berupa teks.',
                'courseName.max' => 'Nama kursus maksimal 255 karakter.',

                'courseSummary.required' => 'Ringkasan kursus wajib diisi.',
                'courseSummary.string' => 'Ringkasan kursus harus berupa teks.',
                'courseSummary.max' => 'Ringkasan kursus maksimal 255 karakter.',

                'courseText.required' => 'Deskripsi kursus wajib diisi.',

                'courseLevel.required' => 'Level kursus wajib dipilih.',
                'courseLevel.in' => 'Level kursus harus berupa dasar, menengah, atau lanjutan.',

                'courseType.required' => 'Kategori kursus wajib dipilih.',
                'courseType.in' => 'Kategori kursus yang dipilih tidak valid.',

                'coursePaymentType.required' => 'Tipe pembayaran kursus wajib dipilih.',
                'coursePaymentType.in' => 'Tipe pembayaran harus gratis atau berbayar.',

                'lecturers.required' => 'Pengajar wajib dipilih.',
                'lecturers.array' => 'Data pengajar tidak valid.',
                'lecturers.size' => 'Pengajar harus berjumlah tepat 3 orang.',

                'lecturers.*.exists' => 'Pengajar yang dipilih tidak ditemukan.',
            ]
        );

        session(['temp_update_course' => $validated]);

        return redirect()->route('admin.courses.editSyllabus', [ 'courseId' => $course->id]);
    }

    public function updateDraftCourseInformation(Request $request, $courseId, $redirect = true)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate(
            [
                'courseName' => 'required|string|max:255',
                'courseSummary' => 'required|string|max:255',
                'courseText' => 'required',
                'courseLevel' => 'required|in:dasar,menengah,lanjutan',
                'courseType' => 'required|in:Seni Tari,Seni Musik,Seni Fotografi,Seni Lukis & Digital Art',
                'coursePaymentType' => 'required|in:gratis,berbayar',
                'lecturers' => 'required|array|size:3',
                'lecturers.*' => 'exists:lecturers,id',
            ],
            [
                'courseName.required' => 'Nama kursus wajib diisi.',
                'courseName.string' => 'Nama kursus harus berupa teks.',
                'courseName.max' => 'Nama kursus maksimal 255 karakter.',

                'courseSummary.required' => 'Ringkasan kursus wajib diisi.',
                'courseSummary.string' => 'Ringkasan kursus harus berupa teks.',
                'courseSummary.max' => 'Ringkasan kursus maksimal 255 karakter.',

                'courseText.required' => 'Deskripsi kursus wajib diisi.',

                'courseLevel.required' => 'Level kursus wajib dipilih.',
                'courseLevel.in' => 'Level kursus harus berupa dasar, menengah, atau lanjutan.',

                'courseType.required' => 'Kategori kursus wajib dipilih.',
                'courseType.in' => 'Kategori kursus yang dipilih tidak valid.',

                'coursePaymentType.required' => 'Tipe pembayaran kursus wajib dipilih.',
                'coursePaymentType.in' => 'Tipe pembayaran harus gratis atau berbayar.',

                'lecturers.required' => 'Pengajar wajib dipilih.',
                'lecturers.array' => 'Data pengajar tidak valid.',
                'lecturers.size' => 'Pengajar harus berjumlah tepat 3 orang.',

                'lecturers.*.exists' => 'Pengajar yang dipilih tidak ditemukan.',
            ]
        );

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
            return redirect()->route('admin.courses.index')->with('success', 'Informasi kursus berhasil diperbarui dan disimpan draft!');
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

        $validated = $request->validate(
            [
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
            ],
            [
                'weeks.array' => 'Data minggu kursus tidak valid.',

                'weeks.*.weekName.required' => 'Judul wajib diisi.',
                'weeks.*.weekName.string' => 'Judul harus berupa teks.',
                'weeks.*.weekName.max' => 'Judul maksimal 255 karakter.',

                'weeks.*.tutorId.required' => 'Tutor untuk minggu ini wajib dipilih.',
                'weeks.*.tutorId.exists' => 'Tutor yang dipilih tidak ditemukan.',

                'weeks.*.materials.array' => 'Data materi pada minggu ini tidak valid.',

                'weeks.*.materials.*.duration.required' => 'Durasi materi wajib diisi.',
                'weeks.*.materials.*.duration.integer' => 'Durasi materi harus berupa angka.',

                'weeks.*.materials.*.articleName.string' => 'Judul artikel harus berupa teks.',
                'weeks.*.materials.*.articleName.max' => 'Judul artikel maksimal 255 karakter.',

                'weeks.*.materials.*.articleText.string' => 'Isi artikel harus berupa teks.',

                'weeks.*.materials.*.vblName.string' => 'Judul video harus berupa teks.',
                'weeks.*.materials.*.vblName.max' => 'Judul video maksimal 255 karakter.',

                'weeks.*.materials.*.vblDesc.string' => 'Deskripsi video harus berupa teks.',

                'weeks.*.materials.*.vblUrl.string' => 'URL video harus berupa teks.',
                'weeks.*.materials.*.vblUrl.max' => 'URL video maksimal 255 karakter.',
            ]
        );

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
            return redirect()->route('admin.courses.index')->with('success', 'Silabus berhasil diperbarui dan disimpan draft!');
        }

        return $course;
    }

    public function tempUpdateSyllabus(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate(
            [
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
            ],
            [
                'weeks.array' => 'Data minggu kursus tidak valid.',

                'weeks.*.weekName.required' => 'Judul wajib diisi.',
                'weeks.*.weekName.string' => 'Judul harus berupa teks.',
                'weeks.*.weekName.max' => 'Judul maksimal 255 karakter.',

                'weeks.*.tutorId.required' => 'Tutor untuk minggu ini wajib dipilih.',
                'weeks.*.tutorId.exists' => 'Tutor yang dipilih tidak ditemukan.',

                'weeks.*.materials.array' => 'Data materi pada minggu ini tidak valid.',

                'weeks.*.materials.*.duration.required' => 'Durasi materi wajib diisi.',
                'weeks.*.materials.*.duration.integer' => 'Durasi materi harus berupa angka.',

                'weeks.*.materials.*.articleName.string' => 'Judul artikel harus berupa teks.',
                'weeks.*.materials.*.articleName.max' => 'Judul artikel maksimal 255 karakter.',

                'weeks.*.materials.*.articleText.string' => 'Isi artikel harus berupa teks.',

                'weeks.*.materials.*.vblName.string' => 'Judul video harus berupa teks.',
                'weeks.*.materials.*.vblName.max' => 'Judul video maksimal 255 karakter.',

                'weeks.*.materials.*.vblDesc.string' => 'Deskripsi video harus berupa teks.',

                'weeks.*.materials.*.vblUrl.string' => 'URL video harus berupa teks.',
                'weeks.*.materials.*.vblUrl.max' => 'URL video maksimal 255 karakter.',
            ]
        );

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

        $validated = $request->validate(
            [
                'projectName' => 'required|string|max:255',
                'projectConcept' => 'required|string',
                'projectRequirement' => 'nullable|string',
                'projectTools' => 'required|array|min:1',
                'projectTools.*' => 'exists:tools,id',
                'criteriaCreativity' => 'required|integer|min:0|max:100',
                'criteriaReadability' => 'required|integer|min:0|max:100',
                'criteriaTheme' => 'required|integer|min:0|max:100',
            ],
            [
                'projectName.required' => 'Nama projek wajib diisi.',
                'projectName.string' => 'Nama projek harus berupa teks.',
                'projectName.max' => 'Nama projek maksimal 255 karakter.',

                'projectConcept.required' => 'Konsep projek wajib diisi.',
                'projectConcept.string' => 'Konsep projek harus berupa teks.',

                'projectRequirement.string' => 'Persyaratan projek harus berupa teks.',

                'projectTools.required' => 'Minimal satu tools wajib dipilih.',
                'projectTools.array' => 'Data tools tidak valid.',
                'projectTools.min' => 'Minimal satu tools wajib dipilih.',
                'projectTools.*.exists' => 'Tools yang dipilih tidak ditemukan.',

                'criteriaCreativity.required' => 'Nilai kreativitas wajib diisi.',
                'criteriaCreativity.integer' => 'Nilai kreativitas harus berupa angka.',
                'criteriaCreativity.min' => 'Nilai kreativitas minimal 0.',
                'criteriaCreativity.max' => 'Nilai kreativitas maksimal 100.',

                'criteriaReadability.required' => 'Nilai keterbacaan wajib diisi.',
                'criteriaReadability.integer' => 'Nilai keterbacaan harus berupa angka.',
                'criteriaReadability.min' => 'Nilai keterbacaan minimal 0.',
                'criteriaReadability.max' => 'Nilai keterbacaan maksimal 100.',

                'criteriaTheme.required' => 'Nilai kesesuaian tema wajib diisi.',
                'criteriaTheme.integer' => 'Nilai kesesuaian tema harus berupa angka.',
                'criteriaTheme.min' => 'Nilai kesesuaian tema minimal 0.',
                'criteriaTheme.max' => 'Nilai kesesuaian tema maksimal 100.',
            ]
        );

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
                        ->with('success', 'Kursus berhasil diperbarui.');
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
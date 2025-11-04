<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Project;
use App\Models\ProjectCriteria;
use App\Models\ProjectSubmission;
use App\Models\ProjectTool;
use App\Models\StudentMateriProgress;
use App\Models\StudentWeekProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private function getFilteredCourses($type, $level, $search = null)
    {
        return Course::when($type, function ($query) use ($type) {
                    $query->where('courseType', $type);
                })
                ->where('courseLevel', $level)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('courseName', 'like', "%$search%")
                        ->orWhere('courseType', 'like', "%$search%")
                        ->orWhere('courseLevel', 'like', "%$search%");
                    });
                })
                ->get();
    }

    public function index(Request $request)
    {
        $type = $request->query('type');
        $search = strtolower($request->query('query'));

        $mappedLevel = null;
        if (str_contains($search, 'level dasar')) {
            $mappedLevel = 'dasar';
        } elseif (str_contains($search, 'level menengah')) {
            $mappedLevel = 'menengah';
        } elseif (str_contains($search, 'level lanjutan')) {
            $mappedLevel = 'lanjutan';
        }

        $baseQuery = Course::query();

        if ($type) {
            $baseQuery->where('courseType', $type);
        }

        if ($search) {
            $baseQuery->where(function ($q) use ($search, $mappedLevel) {
                $q->where('courseName', 'like', "%$search%")
                ->orWhere('courseType', 'like', "%$search%")
                ->orWhere('courseLevel', 'like', "%$search%");

                if ($mappedLevel) {
                    $q->orWhere('courseLevel', $mappedLevel);
                }
            });
        }

        if ($type) {
            $dasarCourses = (clone $baseQuery)
            ->where('courseLevel', 'dasar')
            ->with('courseLecturers.lecturer.user')
            ->get();
            $menengahCourses = (clone $baseQuery)
            ->where('courseLevel', 'menengah')
            ->with('courseLecturers.lecturer.user')
            ->get();
            $lanjutanCourses = (clone $baseQuery)
            ->where('courseLevel', 'lanjutan')
            ->with('courseLecturers.lecturer.user')
            ->get();

            $courses = collect(); 
        } else {
            $dasarCourses = (clone $baseQuery)
            ->where('courseLevel', 'dasar')
            ->with('courseLecturers.lecturer.user')
            ->take(4)
            ->get();
            $menengahCourses = (clone $baseQuery)
            ->where('courseLevel', 'menengah')
            ->with('courseLecturers.lecturer.user')
            ->take(4)
            ->get();
            $lanjutanCourses = (clone $baseQuery)
            ->where('courseLevel', 'lanjutan')
            ->with('courseLecturers.lecturer.user')
            ->take(4)
            ->get();

            $courses = $baseQuery->paginate(16)->withQueryString();
        }

        return view('Artcademy.course', compact('type', 'search', 'dasarCourses', 'menengahCourses', 'lanjutanCourses', 'courses'));
    }

    public function showCourseDetail($id)
    {
        $course = Course::with(['courseLecturers.lecturer.user', 'weeks.materials', 'zooms'])
                        ->findOrFail($id);

        $otherCourses = Course::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(6)
        ->with(['courseLecturers.lecturer.user'])
        ->get();

        $enrolledCourse = Course::with(['courseEnrollments'])->findOrFail($id);
        $isEnrolled = false;
        if(Auth::check()){
            $isEnrolled = $enrolledCourse->courseEnrollments()
            ->where('studentId', Auth::id())
            ->exists();
        }

        $isEnrolled = false;
        $weekProgress = collect();
        $materiProgress = collect();
        $enrollment = null;

        if (Auth::check()) {
            $user = Auth::user();
            $enrollment = CourseEnrollment::where('courseId', $id)
                ->where('studentId', $user->id)
                ->first();

            if ($enrollment) {
                $isEnrolled = true;

                $weekProgress = StudentWeekProgress::where('courseEnrollmentId', $enrollment->id)
                    ->get()
                    ->keyBy('weekId');

                $materiProgress = StudentMateriProgress::where('courseEnrollmentId', $enrollment->id)
                    ->get()
                    ->keyBy('materiId');
            }
        }

        $project = Project::with('course')->firstWhere('courseId', $id);
        $projectTools = ProjectTool::with('project')->where('projectId', '=', $project->id)->get();

        $projectCriterias = ProjectCriteria::with('project')->where('projectId','=',$project->id)->get();
        $submission = ProjectSubmission::where('projectId', $project->id)
                    ->where('studentId', auth()->user()->student->id)
                    ->first();
        
        $isSubmitted = $submission !== null;
        $isDisabled = !$submission;

        $data = [
            'course' => $course,
            'otherCourses' => $otherCourses, 
            'isEnrolled' => $isEnrolled, 
            'weekProgress' => $weekProgress, 
            'materiProgress' =>$materiProgress, 
            'enrollment' => $enrollment, 
            'project' => $project, 
            'projectTools' => $projectTools,
            'projectCriterias' => $projectCriterias,
            'isSubmitted' => $isSubmitted,
            'isDisabled' => $isDisabled,
            'submission' => $submission
        ];

        return view('Artcademy.course-detail', $data);
    }
}

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
        $user = Auth::user();

        if ($user->role === 'student') {
            $layout = 'layouts.master';
        } elseif ($user->role === 'admin') {
            $layout = 'layouts.master-admin';
        } elseif ($user->role === 'lecturer') {
            $layout = 'layouts.master-tutor';
        }
        
        $course = Course::with(['courseLecturers.lecturer.user', 'weeks.materials', 'zooms'])
                        ->findOrFail($id);

        $otherCourses = Course::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(6)
        ->with(['courseLecturers.lecturer.user'])
        ->get();

        $isEnrolled = false;
        $weekProgress = collect();
        $materiProgress = collect();
        $enrollment = null;

        if (Auth::check()) {
            [$isEnrolled, $enrollment, $weekProgress, $materiProgress] = 
            $this->getEnrollmentData($id, Auth::id());
        }

        [$project, $projectTools, $projectCriterias, $submission] = 
            $this->getProjectData($id, Auth::id());

        $isSubmitted = $submission !== null;
        $isDisabled = !$isSubmitted;

        // get data for next week/materi
        $latestUnlockedWeek = $this->getLatestUnlockedWeek($course, $weekProgress);

        // check if all weeks progress is 100, to show project card
        $allWeeksCompleted =  $course->weeks->every(function ($week) use ($weekProgress) {
            $weekProg = $weekProgress[$week->id] ?? null;
            return $weekProg && $weekProg->progress == 100;
        });        

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
            'submission' => $submission,
            'latestUnlockedWeek' => $latestUnlockedWeek,
            'allWeeksCompleted' => $allWeeksCompleted,
            'layout' => $layout
        ];

        return view('Artcademy.course-detail', $data);
    }

    private function getEnrollmentData($courseId, $userId)
    {
        $enrollment = CourseEnrollment::where('courseId', $courseId)
                ->where('studentId', $userId)
                ->first();

        if (!$enrollment) {
            return [false, null, collect(), collect()];
        }

        $weekProgress = StudentWeekProgress::where('courseEnrollmentId', $enrollment->id)
                    ->get()
                    ->keyBy('weekId');

        $materiProgress = StudentMateriProgress::where('courseEnrollmentId', $enrollment->id)
                    ->get()
                    ->keyBy('materiId');

       
        return [true, $enrollment, $weekProgress, $materiProgress];
    }

    private function getProjectData($courseId, $studentId)
    {
        $project = Project::with('course')->firstWhere('courseId', $courseId);

        $projectTools = ProjectTool::where('projectId', $project->id)
            ->with('project')
            ->get();

        $projectCriterias = ProjectCriteria::where('projectId', $project->id)
            ->with('project')
            ->get();

        $submission = auth()->check()
            ? ProjectSubmission::where('projectId', $project->id)
                ->where('studentId', $studentId ?? null)
                ->first()
            : null;

        return [$project, $projectTools, $projectCriterias, $submission];
    }

    private function getLatestUnlockedWeek($course, $weekProgress)
    {
        return $course->weeks->filter(function($week) use ($weekProgress) {
            $progress = $weekProgress[$week->id] ?? null;
            return $progress && $progress->status === 'unlocked';
        })->last();
    }
}

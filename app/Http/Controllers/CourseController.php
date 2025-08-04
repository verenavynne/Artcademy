<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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
}

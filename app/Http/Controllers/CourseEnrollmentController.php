<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseMateri;
use App\Models\CourseWeek;
use App\Models\StudentMateriProgress;
use App\Models\StudentWeekProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseEnrollmentController extends Controller
{
    public function createEnrollment($id)
    {
        $user = Auth::user();

        $existing = CourseEnrollment::where('courseId', $id)
            ->where('studentId', $user->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Kamu sudah terdaftar di kelas ini.');
        }

        $enrollment = CourseEnrollment::create([
            'courseId' => $id,
            'studentId' => $user->id,
            'status' => 'ongoing',
            'startDate' => now(),
            'endDate' => null
        ]);

        $weeks = CourseWeek::where('courseId', $id)
            ->orderBy('id','asc')
            ->get();

        foreach($weeks as $index => $week){
            StudentWeekProgress::create([
                'courseEnrollmentId' => $enrollment->id,
                'weekId' => $week->id,
                'progress' => 0,
                'status' => $index === 0 ? 'unlocked' : 'locked'
            ]);

            foreach ($week->materials as $materi) {
                StudentMateriProgress::create([
                    'courseEnrollmentId' => $enrollment->id,
                    'materiId' => $materi->id,
                    'isDone' => false,
                ]);
            }

        }
       

        return redirect()->back()->with('success', 'Berhasil mendaftar ke kursus!');
    }
}

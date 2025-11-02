<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseMateri;
use App\Models\CourseWeek;
use App\Models\StudentMateriProgress;
use App\Models\StudentWeekProgress;
use App\Models\Zoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseWeekController extends Controller
{
    public function startWeek($courseId)
    {
        $user = Auth::user();

        $enrollment = CourseEnrollment::where('courseId', $courseId)
            ->where('studentId', $user->id)
            ->firstOrFail();

        $weekProgress = StudentWeekProgress::where('courseEnrollmentId', $enrollment->id)
            ->where('status', 'unlocked')
            ->orderBy('id', 'desc') 
            ->first();


        if (!$weekProgress) {
            return redirect()->back()->with('error', 'Belum ada minggu yang tersedia untuk dipelajari.');
        }

        $week = CourseWeek::with('materials')->findOrFail($weekProgress->weekId);

        $materi = StudentMateriProgress::where('courseEnrollmentId', $enrollment->id)
            ->whereHas('materi', function ($q) use ($week) {
                $q->where('weekId', $week->id);
            })
            ->where('isDone', false)
            ->orderBy('materiId')
            ->first();

        if (!$materi) {
            return redirect()->back()->with('info', 'Semua materi minggu ini sudah selesai.');
        }

        return redirect()->route('course.showMateri', [
            'weekId' => $week->id,
            'materiId' => $materi->materiId
        ]);
    }

    public function showMateri($weekId, $materiId)
    {
        $materi = CourseMateri::with(['week.course','week.materials', 'week.tutor', 'materiTools.tool'])->findOrFail($materiId);
       
        $tools = $materi->materiTools->map(fn($mt) => $mt->tool)->filter(); 

        $zooms = Zoom::where('courseId', $materi->week->course->id)
        ->latest() 
        ->take(3)
        ->get();

        $courseId = $materi->week->course->id;
        
        // Data buat carousel course card
        $otherCourses = Course::where('id', '!=', $courseId)
            ->inRandomOrder()
            ->take(6)
            ->with(['courseLecturers.lecturer.user'])
            ->get();

        
        // Ambil data progress untuk course
        $weekProgress = collect();
        $materiProgress = collect();
        $isUnlocked = false;

        if (Auth::check()) {
            $user = Auth::user();

            $enrollment = CourseEnrollment::where('courseId', $courseId)
                ->where('studentId', $user->id)
                ->first();

            if ($enrollment) {
                $weekProgress = StudentWeekProgress::where('courseEnrollmentId', $enrollment->id)
                    ->where('weekId', $weekId)
                    ->first();

                $materiProgress = StudentMateriProgress::where('courseEnrollmentId', $enrollment->id)
                    ->whereIn('materiId', $materi->week->materials->pluck('id'))
                    ->get()
                    ->keyBy('materiId');

                $isUnlocked = $weekProgress?->status === 'unlocked';

                
            }
        }

        $week = $materi->week;

        $data = [
                'materi' => $materi,
                'week' => $week,
                'tools' => $tools,
                'zooms' => $zooms,
                'tutor' => $week->tutor,
                'otherCourses' => $otherCourses,
                'weekProgress' => $weekProgress,
                'materiProgress' => $materiProgress,
                'isUnlocked' => $isUnlocked,
            ];

        if ($materi->vblName !== null) {
            return view('Artcademy.course-week-vbl', $data);
        } elseif ($materi->articleName !== null) {
            return view('Artcademy.course-week-article', $data);
        } else {
           
            return redirect()->back()->with('error', 'Materi tidak ditemukan.');
        }
    }

    public function completeMateri(Request $request, $materiId)
    {
        $materi = CourseMateri::with('week.course', 'week.materials')->findOrFail($materiId);
        $user = Auth::user();

        $enrollment = CourseEnrollment::where('courseId', $materi->week->course->id)
            ->where('studentId', $user->id)
            ->firstOrFail();

        StudentMateriProgress::updateOrCreate(
            [
                'courseEnrollmentId' => $enrollment->id,
                'materiId' => $materiId,
            ],
            [
                'isDone' => true,
            ]
        );

        $totalMateri = $materi->week->materials->count();
        $doneMateri = StudentMateriProgress::where('courseEnrollmentId', $enrollment->id)
            ->whereIn('materiId', $materi->week->materials->pluck('id'))
            ->where('isDone', true)
            ->count();

        $progressPercent = $totalMateri > 0 ? round(($doneMateri / $totalMateri) * 100, 0) : 0;

        StudentWeekProgress::updateOrCreate(
            [
                'courseEnrollmentId' => $enrollment->id,
                'weekId' => $materi->week->id,
            ],
            [
                'progress' => $progressPercent,
                'status' => 'unlocked'
            ]
        );


        $nextMateri = $materi->week->materials
            ->where('id', '>', $materiId)
            ->sortBy('id')
            ->first();

        if ($nextMateri) {
            return redirect()->route('course.showMateri', [
                'weekId' => $materi->week->id,
                'materiId' => $nextMateri->id,
            ]);
        }

        if ($progressPercent == 100) {
            $nextWeek = CourseWeek::where('courseId', $materi->week->course->id)
                ->where('id', '>', $materi->week->id)
                ->orderBy('id')
                ->first();

            if ($nextWeek) {
                StudentWeekProgress::updateOrCreate(
                    [
                        'courseEnrollmentId' => $enrollment->id,
                        'weekId' => $nextWeek->id,
                    ],
                    [
                        'status' => 'unlocked',
                        'progress' => 0,
                    ]
                );

                $firstMateriNextWeek = $nextWeek->materials()->orderBy('id')->first();

                if ($firstMateriNextWeek) {
                    return redirect()->route('course.showMateri', [
                        'weekId' => $nextWeek->id,
                        'materiId' => $firstMateriNextWeek->id,
                    ]);
                }
            }
        }

       return redirect()->route('course.project', $materi->week->course->id)
        ->with('success', 'Kamu telah menyelesaikan semua materi di course ini! Saatnya mengerjakan projek akhir 🎉');
    }

}

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
        $materi = $this->getMateriWithRelations($materiId);
        $week = $materi->week;
        $course = $week->course;
        $courseId = $course->id;
        $tutor = $week->tutor;

        $tools = $materi->materiTools->pluck('tool')->filter();
        $zooms = $this->getZoomSessions($courseId);
        $otherCourses = $this->getOtherCourses($courseId);

        [$weekProgress, $materiProgress, $isUnlocked,  $progressPercent, $firstUndoneId] = $this->getUserProgress($course, $weekId, $materi);

        $navigationData = $this->getNavigationData($materi);

        return view(
            $materi->vblName ? 'Artcademy.course-week-vbl' : 'Artcademy.course-week-article',
            compact('materi', 'week', 'tutor', 'tools', 'zooms', 'otherCourses', 'weekProgress', 'materiProgress', 'progressPercent','firstUndoneId','isUnlocked', 'navigationData')
        );
    }

    private function getMateriWithRelations($materiId)
    {
        return CourseMateri::with([
            'week.course.weeks',
            'week.materials',
            'week.tutor',
            'materiTools.tool'
        ])->findOrFail($materiId);
    }

    private function getZoomSessions($courseId)
    {
        return Zoom::where('courseId', $courseId)
            ->latest()
            ->take(3)
            ->get();
    }

    private function getOtherCourses($courseId)
    {
        return Course::where('id', '!=', $courseId)
            ->inRandomOrder()
            ->take(6)
            ->with(['courseLecturers.lecturer.user'])
            ->get();
    }

    private function getUserProgress($course, $weekId, $materi)
    {
        $weekProgress = collect();
        $materiProgress = collect();
        $isUnlocked = false;

        if (!Auth::check()) {
            return [$weekProgress, $materiProgress, $isUnlocked];
        }

        $user = Auth::user();

        $enrollment = CourseEnrollment::where('courseId', $course->id)
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
            $progressPercent = $weekProgress?->progress ?? 0;
            $firstUndoneId = collect($materiProgress)
                ->filter(fn($progress) => !$progress->isDone)
                ->keys()
                ->sort()
                ->first();
        }

        return [$weekProgress, $materiProgress, $isUnlocked, $progressPercent, $firstUndoneId];
    }

    private function getNavigationData($materi)
    {
        $totalWeeks = $materi->week->course->weeks->count();
        $currentWeekIndex = $materi->week->course->weeks->pluck('id')->search($materi->week->id) + 1;
        $materials = $materi->week->materials;
        $isLastMateri = $materi->id === $materials->last()->id;

        if ($isLastMateri && $currentWeekIndex < $totalWeeks) {
            $buttonText = 'Lanjutkan ke Minggu ' . ($currentWeekIndex + 1);
        } elseif ($isLastMateri && $currentWeekIndex === $totalWeeks) {
            $buttonText = 'Lihat Projek Akhir';
        } else {
            $buttonText = 'Lanjutkan';
        }

        return [
            'totalWeeks' => $totalWeeks,
            'currentWeekIndex' => $currentWeekIndex,
            'isLastMateri' => $isLastMateri,
            'buttonText' => $buttonText,
        ];
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

       return redirect()->route('course.project', $materi->week->course->id);
    }

}

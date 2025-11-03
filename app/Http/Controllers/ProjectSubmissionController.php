<?php

namespace App\Http\Controllers;

use App\Models\CourseLecturer;
use App\Models\LecturerProjectGrade;
use App\Models\ProjectSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProjectSubmissionController extends Controller
{
    public function submitProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => ['required', 'regex:/^(https?:\/\/|www\.)[^\s]+$/'],
            'thumbnail' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'Judul projek wajib diisi.',
            'link.required' => 'Link projek wajib diisi.',
            'link.regex' => 'Link harus diawali dengan https://, http://, atau www.',
            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.mimes' => 'Thumbnail hanya boleh berformat JPG, JPEG, atau PNG.',
        ]);

        $projectId = $request->input('projectId');
        $studentId = Auth::id();

        $existingSubmission = ProjectSubmission::where('projectId', $projectId)
            ->where('studentId', $studentId)
            ->first();

        if ($existingSubmission) {
            return redirect()->back()->with('info', 'Kamu sudah mengumpulkan projek ini sebelumnya.');
        }

        $thumbnailPath = $request->file('thumbnail')->store('project_thumbnails', 'public');

        ProjectSubmission::create([
            'projectId' => $request->input('projectId'), 
            'studentId' => Auth::id(), 
            'projectSubmissionName' => $request->input('title'),
            'projectSubmissionLink' => $request->input('link'),
            'projectSubmissionThumbnail' => $thumbnailPath,
            'projectSubmissionDesc' => $request->input('description'),
            'projectSubmissionDate' => Carbon::now(),
            'deadlineSubmission' => Carbon::now()->addWeek(),
            'status' => 'not_graded',
            'grade' => null,
        ]);

        return redirect()->back()->with('success', 'Projek berhasil dikumpulkan!');
    }

    public function showSubmittedProject($id)
    {
        
        $submission = ProjectSubmission::with(['project.course', 'student'])
            ->where('id', $id)
            ->where('studentId', auth()->id())
            ->firstOrFail();

        $courseId = $submission->project->course->id;

        
        $lecturers = CourseLecturer::with([
            'lecturer.user',
            'projectGrades.projectCriteria.criteria',
            'projectComments'
        ])
        ->where('courseId', $courseId)
        ->get();
       
        $tutorEvaluations = $lecturers->map(function ($lecturer) use ($submission) {
            $grades = $lecturer->projectGrades
                ->where('projectSubmissionId', $submission->id)
                ->map(fn($g) => [
                    'criteria' => $g->projectCriteria->criteria->criteriaName ?? 'Kriteria Tidak Diketahui',
                    'score' => $g->score ?? '-',
                    'icon' => $this->getIconForCriteria($g->projectCriteria->criteria->criteriaName),
                ])
                ->values();

            $comment = optional(
                $lecturer->projectComments
                    ->where('projectSubmissionId', $submission->id)
                    ->first()
            )->comment ?? '-';

            return [
                'name' => $lecturer->lecturer->user->name ?? 'Unknown',
                'specialization' => $lecturer->lecturer->specialization ?? '-',
                'photo' => $lecturer->lecturer->user->profilePicture ?? 'assets/default-profile.jpg',
                'grades' => $grades,
                'comment' => $comment,
            ];
        });

        $totalTutors = $lecturers->count();
        $tutorsThatHaveGraded = $lecturers->filter(function ($lecturer) use ($submission) {
            return $lecturer->projectGrades
                ->where('projectSubmissionId', $submission->id)
                ->isNotEmpty();
        })->count();

        $allTutorsGraded = $totalTutors > 0 && $totalTutors === $tutorsThatHaveGraded;

       
        $scores = $this->calculateProjectScores($submission);

        return view('Artcademy.course-hasil-penilaian', [
            'submission' => $submission,
            'tutors' => $tutorEvaluations,
            'criteriaScores' => $scores['criteriaScores'],
            'totalScore' => $scores['totalScore'],
            'allTutorsGraded' => $allTutorsGraded,
        ]);
    }


    private function calculateProjectScores($submission)
    {
        $criteriaScores = [];
        $total = 0;

        $criteriaList = $submission->project
            ->projectCriterias()
            ->with('criteria')
            ->get();

        $lecturers = $submission->project->course->courseLecturers ?? collect();

        foreach ($criteriaList as $item) {
            $weight = $item->customWeight ?? $item->criteria->criteriaWeight ?? 0;

            $scores = $lecturers->flatMap(fn($lec) =>
                $lec->projectGrades
                    ->where('projectSubmissionId', $submission->id)
                    ->where('projectCriteriaId', $item->id)
                    ->pluck('score')
            );

            $avg = $scores->avg() ?? 0;
            $weighted = $avg * ($weight / 100);

            $criteriaScores[] = [
                'name' => $item->criteria->criteriaName,
                'average' => round($avg, 2),
                'weight' => $weight,
                'weightedScore' => round($weighted, 2),
                'icon' => $this->getIconForCriteria($item->criteria->criteriaName),
            ];

            $total += $weighted;
        }

        return [
            'criteriaScores' => $criteriaScores,
            'totalScore' => round($total, 2),
        ];
    }

    private function getIconForCriteria($name)
    {
        $map = [
            'Kreativitas' => 'criteria_kreativitas.svg',
            'Keterbacaan' => 'criteria_keterbacaan.svg',
            'Kesesuaian Tema' => 'criteria_kesesuaian_tema.svg',
        ];

        return $map[$name] ?? 'default.svg';
    }


}

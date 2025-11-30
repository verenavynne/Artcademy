<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectSubmission;
use App\Models\LecturerProjectGrade;
use App\Models\LecturerProjectComment;

class TutorNilaiProjectController extends Controller
{
    public function index(Request $request)
    {
        $authLecturerId = Auth::id();
        $status = $request->query('status', 'menunggu');

        $submissions = ProjectSubmission::whereHas('project.course.courseLecturers', function ($q) use ($authLecturerId) {
            $q->where('lecturerId', $authLecturerId);
        })
        ->with([
            'student',
            'project.course.courseLecturers',
            'project.projectCriterias.criteria',
            'lecturerGrades' => function ($q) use ($authLecturerId) {
                $q->whereHas('courseLecturer', function ($q2) use ($authLecturerId) {
                    $q2->where('lecturerId', $authLecturerId);
                });
            },
            'lecturerGrades.projectCriteria.criteria'
        ])
        ->get()
        ->map(function ($submission) use ($authLecturerId) {

            $courseLecturerId = $submission->project->course
                ->courseLecturers()
                ->where('lecturerId', $authLecturerId)
                ->value('id');

            $submission->courseLecturerId = $courseLecturerId;

            $submission->isGraded = $submission->lecturerGrades->isNotEmpty();

            return $submission;
        })
        ->filter(function ($submission) use ($status) {
            return $status === 'selesai'
                ? $submission->isGraded
                : !$submission->isGraded;
        });

        return view('lecturer.nilai-projek.nilai-projek', compact('submissions', 'status'));
    }

    public function detail($id)
    {
        $projectSubmission = ProjectSubmission::with(['student.user', 'project'])
            ->findOrFail($id);
            
        $project = $projectSubmission->project;
        $projectTools = $project->projectTools;
        $projectCriterias = $project->projectCriterias;


        return view('lecturer.nilai-projek.detail-nilai-projek', compact('projectSubmission', 'project', 'projectTools', 'projectCriterias'));
    }

    public function send(Request $request, $submissionId)
    {
        $submission = ProjectSubmission::findOrFail($submissionId);

        $authLecturerId = auth()->user()->lecturer->id;

        $courseLecturerId = $submission->project->course
            ->courseLecturers()
            ->where('lecturerId', $authLecturerId)
            ->value('id');

        foreach ($request->scores as $projectCriteriaId => $score) {
            LecturerProjectGrade::create(
                [
                    'courseLecturerId'    => $courseLecturerId,
                    'projectSubmissionId' => $submissionId,
                    'projectCriteriaId'   => $projectCriteriaId,
                    'score' => $score,
                ]
            );
        }

        if ($request->comment) {
            LecturerProjectComment::create(
                [
                    'courseLecturerId'    => $courseLecturerId,
                    'projectSubmissionId' => $submissionId,
                    'comment' => $request->comment,
                ]
            );
        }

        return redirect()->route('lecturer.nilai-projek', ['status' => 'selesai'])
                 ->with('success', 'Penilaian berhasil disimpan!');
    }
}

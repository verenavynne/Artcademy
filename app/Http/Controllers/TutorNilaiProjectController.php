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
        $lecturerId = Auth::id();
        $status = $request->query('status', 'menunggu');

        $submissions = ProjectSubmission::whereHas('project.course.courseLecturers', function ($q) use ($lecturerId) {
            $q->where('lecturerId', $lecturerId);
        })
        ->with(['student', 'project.projectCriterias.criteria', 'lecturerGrades.projectCriteria.criteria'])
        ->get()
        ->filter(function ($submission) use ($lecturerId, $status) {
            $isGraded = $submission->lecturerGrades()
                            ->where('courseLecturerId', $lecturerId)
                            ->exists();

            if ($status === 'selesai') {
                return $isGraded; 
            } else {
                return !$isGraded;
            }
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

        $lecturerId = auth()->user()->lecturer->id;

        foreach ($request->scores as $projectCriteriaId => $score) {
            LecturerProjectGrade::create(
                [
                    'courseLecturerId'    => $lecturerId,
                    'projectSubmissionId' => $submissionId,
                    'projectCriteriaId'   => $projectCriteriaId,
                    'score' => $score,
                ]
            );
        }

        if ($request->comment) {
            LecturerProjectComment::create(
                [
                    'courseLecturerId'    => $lecturerId,
                    'projectSubmissionId' => $submissionId,
                    'comment' => $request->comment,
                ]
            );
        }

        return redirect()->route('lecturer.nilai-projek')
                 ->with('success', 'Penilaian berhasil disimpan!');
    }
}

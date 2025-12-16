<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCriteria;
use App\Models\ProjectSubmission;
use App\Models\ProjectTool;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProject($courseId)
    {
        $project = Project::with('course')->firstWhere('courseId', $courseId);
        $projectTools = ProjectTool::with('project')->where('projectId', '=', $project->id)->get();

        $projectCriterias = ProjectCriteria::with('project')->where('projectId','=',$project->id)->get();

        $submission = ProjectSubmission::firstOrCreate(
            [
                    'projectId' => $project->id,
                    'studentId' => auth()->user()->student->id
                ],
                [
                    'deadlineSubmission' => Carbon::now()->addWeek()
                ]
            );
            

        $isDisabled = empty($submission->projectSubmissionName) &&
            empty($submission->projectSubmissionLink) &&
            empty($submission->projectSubmissionThumbnail);


        $isSubmitted = !$isDisabled && $submission->projectSubmissionDate !== null;

        return view('Artcademy.course-project-submission', compact('project', 'projectTools', 'projectCriterias','isDisabled','isSubmitted','submission'));
    }
}

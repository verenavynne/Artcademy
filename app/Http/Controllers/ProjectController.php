<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCriteria;
use App\Models\ProjectSubmission;
use App\Models\ProjectTool;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProject($courseId)
    {
        $project = Project::with('course')->firstWhere('courseId', $courseId);
        $projectTools = ProjectTool::with('project')->where('projectId', '=', $project->id)->get();

        $projectCriterias = ProjectCriteria::with('project')->where('projectId','=',$project->id)->get();

        $submission = ProjectSubmission::where('projectId', $project->id)
                    ->where('studentId', auth()->user()->student->id)
                    ->first();

        $isDisabled = !$submission || (
            empty($submission->projectSubmissionName) ||
            empty($submission->projectSubmissionLink) ||
            empty($submission->projectSubmissionThumbnail) ||
            empty($submission->projectSubmissionDesc)
        );

        $isSubmitted = $submission !== null;

        return view('Artcademy.course-project-submission', compact('project', 'projectTools', 'projectCriterias','isDisabled','isSubmitted','submission'));
    }
}

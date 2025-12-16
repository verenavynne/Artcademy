<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\ProjectSubmission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckStudentProjectSubmissionDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grade:check-student-project-submission-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification one day before project submission deadline';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $submissions = ProjectSubmission::with('student.user')
        ->whereNull('projectSubmissionDate')
        ->whereDate('deadlineSubmission', $tomorrow)
        ->get();

        foreach($submissions as $submission){
            Notification::create([
                'referenceType' => 'project',
                'referenceId' => $submission->project->course->id,
                'userId' => $submission->student->user->id,
                'actorId' => null,
                'notificationMessage' => 'Deadline pengumpulan projek besok loh!',
                'notificationDate' => now(),
                'status' => 'unread',
            ]);
        };

        return Command::SUCCESS;
    }
}

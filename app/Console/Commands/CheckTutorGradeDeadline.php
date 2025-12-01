<?php

namespace App\Console\Commands;

use App\Models\CourseLecturer;
use App\Models\LecturerProjectGrade;
use App\Models\Notification;
use App\Models\ProjectSubmission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckTutorGradeDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grade:check-tutor-grade-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification one day before tutor grading deadline';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $submissions = ProjectSubmission::whereDate('deadlineSubmission', $tomorrow)
            ->get();

        foreach($submissions as $submission){
            $courseId = $submission->project->courseId;
            $courseLecturerId = CourseLecturer::where('courseId', $courseId)->get();

            foreach($courseLecturerId as $tutorId){
                $exists = LecturerProjectGrade::where('courseLecturerId', $tutorId->id)
                ->where('projectSubmissionId', $submission->id)
                ->exists();

                if(!$exists){
                    Notification::create([
                        'referenceType' => 'project',
                        'referenceId' => $submission->id,
                        'userId' => $tutorId->lecturer->user->id,
                        'actorId' => null, 
                        'notificationMessage' => 'Kamu belum menilai projek ini. Deadlinenya besok lho!',
                        'notificationDate' => now(),
                        'status' => 'unread'
                    ]);
                }
            }

        }
        return Command::SUCCESS;
    }
}

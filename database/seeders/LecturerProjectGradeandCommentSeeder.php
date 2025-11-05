<?php

namespace Database\Seeders;

use App\Models\CourseLecturer;
use App\Models\LecturerProjectComment;
use App\Models\LecturerProjectGrade;
use App\Models\ProjectCriteria;
use App\Models\ProjectSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerProjectGradeandCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissions = ProjectSubmission::with('project')->get();

        if ($submissions->isEmpty()) {
            $this->command->warn('⚠️ No project submissions found.');
            return;
        }

        foreach ($submissions as $submission) {
            $project = $submission->project;

            if (!$project) {
                $this->command->warn("⚠️ Submission ID {$submission->id} has no related project.");
                continue;
            }

            $courseId = $project->courseId;
            if (!$courseId) {
                $this->command->warn("⚠️ Project ID {$project->id} has no courseId.");
                continue;
            }

            $courseLecturers = CourseLecturer::where('courseId', $courseId)->get();
            if ($courseLecturers->isEmpty()) {
                $this->command->warn("⚠️ No course lecturers for course ID {$courseId} (project {$project->id}).");
                continue;
            }

            $criteria = ProjectCriteria::where('projectId', $project->id)->get();
            if ($criteria->isEmpty()) {
                $this->command->warn("⚠️ No criteria for project ID {$project->id}.");
                continue;
            }

            foreach ($courseLecturers as $lecturer) {
                LecturerProjectComment::updateOrCreate(
                    [
                        'courseLecturerId' => $lecturer->id,
                        'projectSubmissionId' => $submission->id,
                    ],
                    [
                        'comment' => \fake()->paragraph(),
                    ]
                );

                foreach ($criteria as $criterion) {
                    LecturerProjectGrade::updateOrCreate(
                        [
                            'courseLecturerId' => $lecturer->id,
                            'projectSubmissionId' => $submission->id,
                            'projectCriteriaId' => $criterion->id,
                        ],
                        [
                            'score' => \fake()->numberBetween(60, 100),
                        ]
                    );
                }
            }

            $this->command->info("Seeded submission {$submission->id}: lecturers={$courseLecturers->count()} criteria={$criteria->count()}");
        }

        $this->command->info('✅ Lecturer grades & feedback seeded successfully!');
    
    }
}

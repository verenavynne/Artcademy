<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseLecturer;
use App\Models\Course;
use App\Models\Lecturer;

class CourseLecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapping = [
            'Seni Tari' => 'Seni Tari',
            'Seni Musik' => 'Seni Musik',
            'Seni Fotografi' => 'Seni Fotografi',
            'Seni Lukis & Digital Art' => 'Seni Lukis & Digital Art',
        ];

        $lecturers = Lecturer::all();

        foreach ($lecturers as $lecturer) {
            $specialization = trim($lecturer->specialization);
            $courseType = $mapping[$specialization] ?? null;

            if (!$courseType) continue;

            $courses = Course::where('courseType', $courseType)->get();

            foreach ($courses as $course) {
                $created = CourseLecturer::firstOrCreate([
                    'lecturerId' => $lecturer->id,
                    'courseId' => $course->id,
                ]);
                $this->command->info('Created: ' . $created->id);
            }
        }

    }
}

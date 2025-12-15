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

        foreach ($mapping as $specialization => $courseType) {

            $lecturers = Lecturer::where('specialization', $specialization)
                ->inRandomOrder()
                ->get();

            if ($lecturers->count() < 3) continue;

            $courses = Course::where('courseType', $courseType)->get();

            foreach ($courses as $course) {

                $selectedLecturers = $lecturers->random(3);

                foreach ($selectedLecturers as $lecturer) {
                    CourseLecturer::firstOrCreate([
                        'lecturerId' => $lecturer->id,
                        'courseId' => $course->id,
                    ]);
                }
            }
        }
    }
}

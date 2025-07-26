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
            'tari' => 'Seni Tari',
            'musik' => 'Seni Musik',
            'fotografi' => 'Seni Fotografi',
            'lukis' => 'Seni Lukis & Digital Art',
        ];

        $lecturers = Lecturer::all();

        foreach ($lecturers as $lecturer) {
            $specialization = strtolower(trim($lecturer->specialization));
            $courseType = $mapping[$specialization] ?? null;

            if (!$courseType) continue;

            // Dapatkan semua course yang sesuai tipe
            $courses = Course::where('courseType', $courseType)->get();

            foreach ($courses as $course) {
                CourseLecturer::firstOrCreate([
                    'lecturerId' => $lecturer->id,
                    'courseId' => $course->id,
                ]);
            }
        }
    }
}

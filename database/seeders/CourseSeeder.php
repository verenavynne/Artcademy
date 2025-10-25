<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): voidc
    {
        $courseTypes = ['Seni Lukis & Digital Art', 'Seni Tari', 'Seni Musik', 'Seni Fotografi'];
        $courseLevels = ['dasar', 'menengah', 'lanjutan'];

        foreach ($courseTypes as $type) {
            foreach ($courseLevels as $level) {
                for ($i = 0; $i < 2; $i++) {
                    Course::create([
                        'courseName' => 'Fundamental Komposisi Visual dan Teknik Pewarnaan Digital',
                        'courseText' => 'Ingin berkarier di industri game atau film sebagai concept artist? Course ini adalah langkah pertamamu! Kamu akan mempelajari fundamental concept art—mulai dari desain karakter, environment, hingga prop design—dengan pendekatan praktis ala profesional. Di akhir course, kamu akan memiliki 1 karya concept art lengkap yang siap jadi bagian portofoliomu!',
                        'coursePicture' => 'assets/course/course_default_picture.png',
                        'courseLevel' => $level,
                        'courseType' => $type,
                        'courseDurationInMinutes' => 507,
                        'courseReview' => 4.9,
                    ]);
                }
            }
        }
    }
}

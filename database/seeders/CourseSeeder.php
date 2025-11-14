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
    public function run(): void
    {
        $courseTypes = [
            'Seni Lukis & Digital Art' => 'assets/course/course_seni_lukis.png',
            'Seni Tari' => 'assets/course/course_seni_tari.png',
            'Seni Musik' => 'assets/course/course_seni_musik.png',
            'Seni Fotografi' => 'assets/course/course_seni_fotografi.png',
        ];

        $courseLevels = ['dasar', 'menengah', 'lanjutan'];

        foreach ($courseTypes as $type => $picturePath) {
            foreach ($courseLevels as $level) {
                for ($i = 0; $i < 2; $i++) {
                    Course::create([
                        'courseName' => $this->generateCourseName($type, $level),
                        'courseSummary' => 'Pelajari dasar-dasar komposisi visual dan teknik pewarnaan digital untuk menciptakan karya seni yang memukau dan penuh ekspresi.',
                        'courseText' => 'Ingin berkarier di industri kreatif? Di course ini kamu akan belajar konsep dasar dan praktik nyata sesuai bidang seni pilihanmu!',
                        'coursePicture' => $picturePath,
                        'courseLevel' => $level,
                        'courseType' => $type,
                        'courseDurationInMinutes' => rand(300, 600),
                        'courseReview' => rand(45, 50) / 10, 
                        'coursePaymentType' => 'berbayar',
                        'courseStatus' => 'publikasi',
                    ]);
                }
            }
        }
    }

    private function generateCourseName(string $type, string $level): string
    {
        $baseNames = [
            'Seni Lukis & Digital Art' => 'Fundamental Komposisi Visual dan Teknik Pewarnaan Digital',
            'Seni Tari' => 'Teknik Dasar dan Koreografi dalam Seni Tari',
            'Seni Musik' => 'Eksplorasi Ritme dan Melodi dalam Musik Modern',
            'Seni Fotografi' => 'Dasar Fotografi: Komposisi, Cahaya, dan Cerita Visual',
        ];

        return $baseNames[$type] . ' - Level ' . ucfirst($level);
    }

}

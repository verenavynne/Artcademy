<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weeks = [
            'Seni Lukis & Digital Art' => [
                'Minggu 1: Pengenalan Concept Art & Ideation',
                'Minggu 2: Desain Karakter Dasar',
                'Minggu 3: Environment & Props Design',
                'Minggu 4: Projek Akhir'
            ],
            'Seni Tari' => [
                'Minggu 1: Dasar Gerak dan Irama',
                'Minggu 2: Teknik Tari Tradisional',
                'Minggu 3: Koreografi dan Improvisasi',
                'Minggu 4: Penampilan Akhir'
            ],
            'Seni Musik' => [
                'Minggu 1: Teori Musik Dasar',
                'Minggu 2: Instrumen dan Vokal',
                'Minggu 3: Komposisi dan Aransemen',
                'Minggu 4: Performance Project'
            ],
            'Seni Fotografi' => [
                'Minggu 1: Dasar Kamera dan Pencahayaan',
                'Minggu 2: Komposisi Visual',
                'Minggu 3: Fotografi Potret & Lanskap',
                'Minggu 4: Editing & Portofolio'
            ]
        ];

        foreach (Course::all() as $course) {
            if (isset($weeks[$course->courseType])) {
                foreach ($weeks[$course->courseType] as $weekName) {
                    CourseWeek::create([
                        'courseId' => $course->id,
                        'weekName' => $weekName
                    ]);
                }
            }
        }
    }
}

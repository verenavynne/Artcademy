<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLecturer;
use App\Models\Zoom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zoomTemplates = [
            'Seni Lukis & Digital Art' => [
                [
                    'zoomName' => 'Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit',
                    'zoomDate' => '2025-06-01',
                    'zoomLink' => 'https://zoom.us/j/1234567890'
                ],
                [
                    'zoomName' => 'Workshop: Digital Painting dengan Tablet Grafis',
                    'zoomDate' => '2025-06-08',
                    'zoomLink' => 'https://zoom.us/j/9876543210'
                ],
                [
                    'zoomName' => 'Workshop: Belajar Temporary Art Selama 2 Jam',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/9876543210'
                ],
            ],
            'Seni Musik' => [
                [
                    'zoomName' => 'Live Jamming Session: Improvisasi Jazz',
                    'zoomDate' => '2025-06-02',
                    'zoomLink' => 'https://zoom.us/j/5556667777'
                ],
                [
                    'zoomName' => 'Workshop: Dasar Komposisi Musik Digital',
                    'zoomDate' => '2025-06-09',
                    'zoomLink' => 'https://zoom.us/j/1122334455'
                ],
                [
                    'zoomName' => 'Workshop: Belajar Gitar Pemula',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/1122334455'
                ],
            ],
            'Seni Tari' => [
                [
                    'zoomName' => 'Demo Tari Kontemporer: Gerak & Ekspresi',
                    'zoomDate' => '2025-06-03',
                    'zoomLink' => 'https://zoom.us/j/9988776655'
                ],
                [
                    'zoomName' => 'Demo Tari Kpop',
                    'zoomDate' => '2025-06-04',
                    'zoomLink' => 'https://zoom.us/j/9988776655'
                ],
                [
                    'zoomName' => 'Demo Tari Tradisional',
                    'zoomDate' => '2025-07-03',
                    'zoomLink' => 'https://zoom.us/j/9988776655'
                ]
            ],
            'Seni Fotografi' => [
                [
                    'zoomName' => 'Live Demo: Fotografi Potret dengan Cahaya Alami',
                    'zoomDate' => '2025-06-04',
                    'zoomLink' => 'https://zoom.us/j/6677889900'
                ],
                [
                    'zoomName' => 'Workshop: Editing Foto Profesional dengan Lightroom',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/4455667788'
                ],
                [
                    'zoomName' => 'Workshop: Fotografi Perspektif',
                    'zoomDate' => '2025-06-11',
                    'zoomLink' => 'https://zoom.us/j/4455667788'
                ],
            ],
        ];

        foreach (Course::all() as $course) {
            $type = $course->courseType;

            $tutors = CourseLecturer::where('courseId', $course->id)->get();

            if ($tutors->isEmpty() || !isset($zoomTemplates[$type])) {
                continue;
            }

            foreach ($zoomTemplates[$type] as $zoom) {
                $tutor = $tutors->random();

                Zoom::firstOrCreate(
                    [
                        'courseId' => $course->id,
                        'zoomName' => $zoom['zoomName'],
                    ],
                    [
                        'tutorId'  => $tutor->id,
                        'zoomDate' => Carbon::parse($zoom['zoomDate']),
                        'zoomLink' => $zoom['zoomLink'],
                    ]
                );
            }
        };

        $this->command->info('ZoomSeeder completed');

    }
}

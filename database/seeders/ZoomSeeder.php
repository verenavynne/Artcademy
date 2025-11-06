<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLecturer;
use App\Models\Zoom;
use Carbon\Carbon;
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
                    'zoomLink' => 'https://zoom.us/j/1234567890',
                    'zoomDesc' => 'Belajar cara mendesain karakter dari sketsa hingga final render menggunakan teknik digital painting.',
                    'zoomDuration' => 90,
                    'zoomQuota' => 100,
                    'start_time' => '12:00:00',
                    'end_time' => '13:30:00',
                ],
                [
                    'zoomName' => 'Workshop: Digital Painting dengan Tablet Grafis',
                    'zoomDate' => '2025-06-08',
                    'zoomLink' => 'https://zoom.us/j/9876543210',
                    'zoomDesc' => 'Pelajari dasar penggunaan tablet grafis dan teknik shading digital painting.',
                    'zoomDuration' => 120,
                    'zoomQuota' => 80,
                    'start_time' => '10:00:00',
                    'end_time' => '12:00:00',
                ],
                [
                    'zoomName' => 'Workshop: Belajar Temporary Art Selama 2 Jam',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/9876543210',
                    'zoomDesc' => 'Eksperimen dengan gaya seni sementara seperti sand art dan body painting.',
                    'zoomDuration' => 120,
                    'zoomQuota' => 70,
                    'start_time' => '13:00:00',
                    'end_time' => '15:00:00',
                ],
            ],
            'Seni Musik' => [
                [
                    'zoomName' => 'Live Jamming Session: Improvisasi Jazz',
                    'zoomDate' => '2025-06-02',
                    'zoomLink' => 'https://zoom.us/j/5556667777',
                    'zoomDesc' => 'Latihan improvisasi jazz bersama tutor dan peserta lain secara live.',
                    'zoomDuration' => 60,
                    'zoomQuota' => 60,
                    'start_time' => '19:00:00',
                    'end_time' => '20:00:00',
                ],
                [
                    'zoomName' => 'Workshop: Dasar Komposisi Musik Digital',
                    'zoomDate' => '2025-06-09',
                    'zoomLink' => 'https://zoom.us/j/1122334455',
                    'zoomDesc' => 'Pengenalan software musik digital dan cara membuat komposisi sederhana.',
                    'zoomDuration' => 90,
                    'zoomQuota' => 100,
                    'start_time' => '14:00:00',
                    'end_time' => '15:30:00',
                ],
                [
                    'zoomName' => 'Workshop: Belajar Gitar Pemula',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/1122334455',
                    'zoomDesc' => 'Belajar chord dasar dan teknik petikan untuk pemula.',
                    'zoomDuration' => 60,
                    'zoomQuota' => 50,
                    'start_time' => '09:00:00',
                    'end_time' => '10:00:00',
                ],
            ],
            'Seni Tari' => [
                [
                    'zoomName' => 'Demo Tari Kontemporer: Gerak & Ekspresi',
                    'zoomDate' => '2025-06-03',
                    'zoomLink' => 'https://zoom.us/j/9988776655',
                    'zoomDesc' => 'Demonstrasi gerak kontemporer untuk mengasah ekspresi tubuh.',
                    'zoomDuration' => 75,
                    'zoomQuota' => 50,
                    'start_time' => '15:00:00',
                    'end_time' => '16:15:00',
                ],
                [
                    'zoomName' => 'Demo Tari Kpop',
                    'zoomDate' => '2025-06-04',
                    'zoomLink' => 'https://zoom.us/j/9988776655',
                    'zoomDesc' => 'Belajar koreografi lagu K-pop populer bersama tutor berpengalaman.',
                    'zoomDuration' => 90,
                    'zoomQuota' => 100,
                    'start_time' => '13:00:00',
                    'end_time' => '14:30:00',
                ],
                [
                    'zoomName' => 'Demo Tari Tradisional',
                    'zoomDate' => '2025-07-03',
                    'zoomLink' => 'https://zoom.us/j/9988776655',
                    'zoomDesc' => 'Eksplorasi gerakan dan makna di balik tari tradisional Indonesia.',
                    'zoomDuration' => 90,
                    'zoomQuota' => 80,
                    'start_time' => '09:00:00',
                    'end_time' => '10:30:00',
                ],
            ],
            'Seni Fotografi' => [
                [
                    'zoomName' => 'Live Demo: Fotografi Potret dengan Cahaya Alami',
                    'zoomDate' => '2025-06-04',
                    'zoomLink' => 'https://zoom.us/j/6677889900',
                    'zoomDesc' => 'Belajar mengatur pencahayaan alami untuk hasil foto potret profesional.',
                    'zoomDuration' => 90,
                    'zoomQuota' => 70,
                    'start_time' => '10:00:00',
                    'end_time' => '11:30:00',
                ],
                [
                    'zoomName' => 'Workshop: Editing Foto Profesional dengan Lightroom',
                    'zoomDate' => '2025-06-10',
                    'zoomLink' => 'https://zoom.us/j/4455667788',
                    'zoomDesc' => 'Panduan lengkap mengedit foto dengan Adobe Lightroom.',
                    'zoomDuration' => 120,
                    'zoomQuota' => 100,
                    'start_time' => '13:00:00',
                    'end_time' => '15:00:00',
                ],
                [
                    'zoomName' => 'Workshop: Fotografi Perspektif',
                    'zoomDate' => '2025-06-11',
                    'zoomLink' => 'https://zoom.us/j/4455667788',
                    'zoomDesc' => 'Belajar teknik perspektif untuk menciptakan foto yang lebih dinamis.',
                    'zoomDuration' => 120,
                    'zoomQuota' => 90,
                    'start_time' => '09:00:00',
                    'end_time' => '11:00:00',
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
                        'tutorId' => $tutor->id,
                        'zoomDesc' => $zoom['zoomDesc'],
                        'zoomLink' => $zoom['zoomLink'],
                        'zoomDuration' => $zoom['zoomDuration'],
                        'zoomQuota' => $zoom['zoomQuota'],
                        'zoomDate' => Carbon::parse($zoom['zoomDate']),
                        'start_time' => $zoom['start_time'],
                        'end_time' => $zoom['end_time'],
                    ]
                );
            }
        }
    }
}

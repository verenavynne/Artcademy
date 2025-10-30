<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'projectName' => 'Desain Karakter Original untuk Game / Film',
                'projectConcept' => 'Buat satu karakter original (hero, villain, atau NPC) untuk game atau film dengan tema imajinatif dan eksploratif.',
                'projectRequirement' => 'Siluet jelas, 3 angle view, dan lembar konsep yang menjelaskan karakter serta kekuatannya.'
            ],
            [
                'projectName' => 'Poster Kampanye Sosial Digital',
                'projectConcept' => 'Membuat poster kampanye dengan pesan sosial menggunakan desain grafis kreatif.',
                'projectRequirement' => 'Gunakan warna yang kuat, tipografi yang jelas, dan pesan yang mudah dipahami.'
            ],
            [
                'projectName' => 'Aplikasi Mobile Sederhana',
                'projectConcept' => 'Buat prototype aplikasi dengan fokus pada user experience dan tampilan yang menarik.',
                'projectRequirement' => 'Gunakan framework pilihan, sertakan wireframe, dan tampilkan simulasi interaksi pengguna.'
            ],
            [
                'projectName' => 'Animasi Pendek 2D / 3D',
                'projectConcept' => 'Buat animasi pendek berdurasi maksimal 1 menit dengan cerita singkat dan karakter menarik.',
                'projectRequirement' => 'Gunakan storyboard, audio sinkron, dan ekspresi karakter yang kuat.'
            ],
            [
                'projectName' => 'Desain UI Website Portofolio',
                'projectConcept' => 'Rancang tampilan antarmuka untuk website portofolio profesional.',
                'projectRequirement' => 'Gunakan prinsip desain modern, warna konsisten, dan layout yang responsif.'
            ],
        ];

        $courses = Course::all();

        foreach ($courses as $course) {
            $project = collect($projects)->random(); 

            Project::create([
                'courseId' => $course->id,
                'projectName' => $project['projectName'],
                'projectConcept' => $project['projectConcept'],
                'projectRequirement' => $project['projectRequirement'],
            ]);
        }
    }
}

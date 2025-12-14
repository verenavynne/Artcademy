<?php

namespace Database\Seeders;
use App\Models\Course;
use App\Models\Testimoni;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimoniTexts = [
            'Materi yang disampaikan sangat terstruktur dan mudah dipahami.',
            'Kursus ini memberikan wawasan baru yang sangat bermanfaat.',
            'Penyampaian materi jelas dan sesuai dengan silabus.',
            'Kualitas pembelajaran sangat baik dan profesional.',
            'Materi disusun dengan rapi dan sistematis. Sangat membantu proses belajar.',
            'Tutor menjelaskan dengan bahasa yang mudah dipahami. Latihan yang diberikan juga relevan.',
            'Pembelajaran berjalan efektif dan tidak membosankan. Saya merasa kemampuan saya meningkat.',
            'Setiap modul dijelaskan secara detail. Cocok untuk pemula maupun lanjutan.',
            'Penjelasannya oke dan gampang dimengerti.',
            'Materinya cukup lengkap dan jelas.',
            'Belajarnya enak, nggak terlalu berat.',
            'Kursus ini cukup membantu untuk mengasah skill.',
            'Tutornya asik jadi ga jenuh pas ikutin zoomnya.',
            'Materinya dapet dan ga ribet.',
            'Tutor nya enak jelasin, jadi cepet nangkep.',
            'Awalnya ragu, tapi ternyata bagus.',
            'Enjoy banget proses belajarnya. Zoomnya juga ngebantu bgt untuk belajar.',
            'Ga nyesel ikut kelas ini.'
        ];

        $students = Student::pluck('id');

        if ($students->count() < 4) {
            return;
        }

        Course::all()->each(function ($course) use ($students, $testimoniTexts) {
            $selectedStudents = $students->random(4);

            foreach ($selectedStudents as $studentId) {
                Testimoni::create([
                    'courseId' => $course->id,
                    'studentId' => $studentId,
                    'rating' => rand(40, 50) / 10,
                    'testimoniContent' => $testimoniTexts[array_rand($testimoniTexts)],
                ]);
            }
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // LECTURER
        $lecturers = [
            'Seni Lukis & Digital Art' => [
                ['name' => 'Budi Santoso', 'profession' => 'Ilustrator Digital'],
                ['name' => 'Nadia Prameswari', 'profession' => 'Concept Artist'],
                ['name' => 'Rizky Aditya', 'profession' => 'Visual Designer'],
            ],
            'Seni Tari' => [
                ['name' => 'Siti Aulia', 'profession' => 'Penari Tradisional'],
                ['name' => 'Dewi Maharani', 'profession' => 'Koreografer'],
                ['name' => 'Andra Wijaya', 'profession' => 'Instruktur Tari Modern'],
            ],
            'Seni Musik' => [
                ['name' => 'Fajar Nugroho', 'profession' => 'Musisi & Komposer'],
                ['name' => 'Kevin Pratama', 'profession' => 'Music Producer'],
                ['name' => 'Intan Lestari', 'profession' => 'Vocal Coach'],
            ],
            'Seni Fotografi' => [
                ['name' => 'Arya Putra', 'profession' => 'Fotografer Profesional'],
                ['name' => 'Maya Kusuma', 'profession' => 'Fotografer Fashion'],
                ['name' => 'Dion Saputra', 'profession' => 'Visual Storyteller'],
            ],
        ];

        $lecturerIndex = 1;

        foreach ($lecturers as $category => $tutors) {
            foreach ($tutors as $tutor) {
                $user = User::create([
                    'name' => $tutor['name'],
                    'email' => "lecturer{$lecturerIndex}@gmail.com",
                    'password' => Hash::make('password'),
                    'role' => 'lecturer',
                    'profession' => $tutor['profession'],
                    'phoneNumber' => '+6281234567' . str_pad($lecturerIndex, 2, '0', STR_PAD_LEFT),
                    'userStatus' => 'active',
                ]);

                Lecturer::create([
                    'id' => $user->id,
                    'specialization' => $category,
                ]);

                $lecturerIndex++;
            }
        }

        // STUDENT
        $students = [
            ['name' => 'Andi Pratama', 'profession' => 'Mahasiswa'],
            ['name' => 'Dewi Lestari', 'profession' => 'Pelajar SMA'],
            ['name' => 'Rina Oktaviani', 'profession' => 'Fresh Graduate'],
            ['name' => 'Bayu Saputra', 'profession' => 'Content Creator'],
            ['name' => 'Nabila Putri', 'profession' => 'Mahasiswa Desain'],
            ['name' => 'Fajar Hidayat', 'profession' => 'Karyawan Swasta'],
            ['name' => 'Salsa Maharani', 'profession' => 'Mahasiswa Seni'],
            ['name' => 'Rizky Ramadhan', 'profession' => 'Freelance Illustrator'],
            ['name' => 'Aulia Rahman', 'profession' => 'UI/UX Enthusiast'],
            ['name' => 'Putri Anindya', 'profession' => 'Pelajar SMK Multimedia'],
        ];

        $studentIndex = 1;

        foreach ($students as $student) {
            $user = User::create([
                'name' => $student['name'],
                'email' => "student{$studentIndex}@gmail.com",
                'password' => Hash::make('password'),
                'role' => 'student',
                'profession' => $student['profession'],
                'phoneNumber' => '+62812345678' . $studentIndex,
                'userStatus' => 'active',
            ]);

            Student::create([
                'id' => $user->id,
            ]);

            $studentIndex++;
        }
    }
}

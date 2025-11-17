<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = [
            [
                'membershipName' => 'Basic Canvas',
                'membershipPrice' => 49000,
                'membershipDesc' => 'Mulai petualangan senimu dari langkah pertama! Di level ini, kamu akan mengenal dasar-dasar berbagai bidang seni, mulai dari lukis, musik, hingga fotografi. Cocok buat kamu yang baru ingin mencoba berkarya, memahami teknik dasar, dan membangun rasa percaya diri. Temukan minat dan passion-mu sebelum melangkah ke level berikutnya.',
                'membershipBenefits' => ['Akses semua kursus Level Dasar', 'Sertifikat digital resmi Artcademy', 'Upload hingga 5 portofolio', 'Akses komunitas']
            ],

            [
                'membershipName' => 'Creative Studio',
                'membershipPrice' => 99000,
                'membershipDesc' => 'Mulai langkah pertamamu di dunia seni dengan akses ke semua kursus level dasar. Cocok buat kamu yang baru mulai berkarya, ingin coba berbagai bidang seni, dan ingin membangun fondasi kreatif yang kuat. Di tahap ini, kamu bisa mengenal berbagai teknik dasar dari lukis, musik, fotografi, hingga tari. Bangun rasa percaya diri dan temukan passion-mu sebelum melangkah ke level selanjutnya.',
                'membershipBenefits' => ['Akses kursus Level Dasar & Menengah', 'Sertifikasi digital resmi Artcademy','Upload hingga 10 portofolio', 'Akses komunitas + fitur chatbot apollo']
            ],

            [
                'membershipName' => 'Masterpiece Pro',
                'membershipPrice' => 149000,
                'membershipDesc' => 'Nikmati akses penuh ke semua level kursus, mulai dari dasar, menengah, hingga lanjutan! Cocok bagi yang ingin menguasai berbagai bidang seni secara menyeluruh. Kembangkan dan ekspresikan kemampuan senimu secara maksimal, asah kreativitas ke tingkat profesional, dan ciptakan karya yang unik.',
                'membershipBenefits' => ['Akses kursus Level Dasar, Menengah, Lanjutan', 'Sertifikasi digital resmi Artcademy', 'Upload portofolio tanpa batas', 'Akses komunitas + fitur chatbot apollo']
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        };
    }
}

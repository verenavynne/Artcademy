<?php

namespace Database\Seeders;

use App\Models\CourseMateri;
use App\Models\CourseWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materis = [
            // 🎨 SENI LUKIS & DIGITAL ART
            'Seni Lukis & Digital Art' => [
                'Minggu 1: Pengenalan Concept Art & Ideation' => [
                    [
                        'materiName' => 'Apa itu Concept Art?',
                        'articleName' => 'Pengantar Concept Art',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menemukan Ide Awal',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Brainstorming Ide untuk Art',
                        'vblDesc' => 'Cara brainstorming ide secara efektif',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 20
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 2',
                        'articleName' => 'Pelajari Konsep Art dalam Film',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 3',
                        'articleName' => 'Pelajari Konsep Art dalam Game',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 4',
                        'articleName' => 'Pelajari Konsep Art dalam Lukisan',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 2: Desain Karakter Dasar' => [
                    [
                        'materiName' => 'Proporsi dan Gesture',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Proporsi Tubuh',
                        'vblDesc' => 'Pelajari dasar proporsi tubuh manusia',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian',
                        'articleName' => 'Membangun Ekspresi Karakter',
                        'articleText' => 'Cara menampilkan kepribadian karakter melalui desain visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 2',
                        'articleName' => 'Gaya Visual Kartun',
                        'articleText' => 'Cara menonjolkan ekspresi dalam desain karakter kartun.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 3',
                        'articleName' => 'Menampilkan Emosi Karakter',
                        'articleText' => 'Teknik menggambarkan emosi yang kuat dalam ilustrasi karakter.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 4',
                        'articleName' => 'Kepribadian Melalui Warna dan Bentuk',
                        'articleText' => 'Gunakan warna dan bentuk untuk memperkuat karakter visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Environment & Props Design' => [
                    [
                        'materiName' => 'Perspektif 1-Point & 2-Point untuk Pemula',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Perspektif Dasar',
                        'vblDesc' => 'Dasar perspektif untuk environment design',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Mood Board: Cara Cari Referensi Efisien',
                        'articleName' => 'Panduan Membuat Mood Board',
                        'articleText' => 'Artikel tentang cara mengumpulkan referensi visual efektif.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Speed Painting Environment Fantasi/Sci-fi',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Speed Painting Fantasi',
                        'vblDesc' => 'Teknik speed painting dengan gaya fantasi/sci-fi',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Prop Design (Senjata, Kendaraan) yang Fungsional',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Prop Design Fungsional',
                        'vblDesc' => 'Merancang prop yang fungsional dan menarik secara visual',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                ],
            ],

            // 💃 SENI TARI
            'Seni Tari' => [
                'Minggu 1: Dasar Gerak dan Irama' => [
                    [
                        'materiName' => 'Pemanasan Tubuh Penari',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Pemanasan Penari',
                        'vblDesc' => 'Latihan dasar fleksibilitas dan kekuatan tubuh.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo',
                        'articleName' => 'Memahami Ritme dalam Gerakan',
                        'articleText' => 'Penjelasan tentang sinkronisasi gerak dan musik dalam tarian.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo 2',
                        'articleName' => 'Gerak Harmonis dengan Musik',
                        'articleText' => 'Bagaimana menyesuaikan tempo tubuh dengan beat musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo 3',
                        'articleName' => 'Teknik Sinkronisasi Gerak',
                        'articleText' => 'Langkah-langkah agar gerak tari mengikuti alunan musik dengan tepat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 2: Teknik Tari Tradisional' => [
                    [
                        'materiName' => 'Gerak Tari Daerah',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Nusantara',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Saman',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Saman Aceh',
                        'vblDesc' => 'Gerak cepat dan serempak khas tari tradisional Aceh.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Kpop',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Modern K-Pop',
                        'vblDesc' => 'Teknik dasar koreografi modern yang dinamis dan ekspresif.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Barat',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Kontemporer Barat',
                        'vblDesc' => 'Eksplorasi gerak tari barat dengan teknik ekspresif dan improvisatif.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Koreografi dan Improvisasi' => [
                    [
                        'materiName' => 'Menyusun Pola Gerak',
                        'articleName' => 'Dasar Menyusun Koreografi',
                        'articleText' => 'Panduan menyusun urutan gerak untuk pertunjukan tari.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Improvisasi di Atas Panggung',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Improvisasi Panggung',
                        'vblDesc' => 'Teknik improvisasi penari profesional saat tampil langsung.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menyusun Pola Gerak 2',
                        'articleName' => 'Struktur Gerakan Tarian',
                        'articleText' => 'Teknik menciptakan variasi gerakan dalam satu koreografi.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menyusun Pola Gerak 3',
                        'articleName' => 'Alur dan Transisi Gerakan',
                        'articleText' => 'Menciptakan transisi halus antar bagian dalam tarian.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menyusun Pola Gerak 4',
                        'articleName' => 'Ekspresi dalam Koreografi',
                        'articleText' => 'Menggabungkan emosi dan narasi dalam setiap gerakan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 4: Penampilan Akhir' => [
                    [
                        'materiName' => 'Latihan Akhir Pertunjukan',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Gladi Resik Pertunjukan',
                        'vblDesc' => 'Simulasi penampilan penuh di panggung.',
                        'vblUrl' => 'https://youtu.be/u5IhtyOsEzE?si=v6aS46WPTLFP44Z4',
                        'duration' => 10
                    ],
                ],
            ],

            // 🎵 SENI MUSIK
            'Seni Musik' => [
                'Minggu 1: Teori Musik Dasar' => [
                    [
                        'materiName' => 'Nada dan Skala',
                        'articleName' => 'Mengenal Tangga Nada',
                        'articleText' => 'Pelajari dasar tangga nada mayor dan minor serta penggunaannya.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 2',
                        'articleName' => 'Interval dan Harmoni',
                        'articleText' => 'Bagaimana interval membentuk harmoni dalam musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 3',
                        'articleName' => 'Chord Dasar untuk Pemula',
                        'articleText' => 'Penjelasan tentang pembentukan chord mayor, minor, dan dim.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 4',
                        'articleName' => 'Progresi Akor Populer',
                        'articleText' => 'Memahami progresi akor yang sering digunakan dalam lagu.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 5',
                        'articleName' => 'Membaca Notasi Musik',
                        'articleText' => 'Cara membaca partitur dan simbol musik dasar.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],

                'Minggu 2: Instrumen dan Vokal' => [
                    [
                        'materiName' => 'Teknik Vokal Dasar',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Vokal Pemula',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Resonansi Suara',
                        'vblDesc' => 'Pelajari resonansi dan kontrol nada untuk suara yang stabil.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Teknik Pernapasan Diafragma',
                        'vblDesc' => 'Cara mengatur napas agar suara tidak mudah habis saat bernyanyi.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 4',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Vibrato dan Dinamika',
                        'vblDesc' => 'Melatih variasi suara agar lebih ekspresif.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],

                'Minggu 3: Komposisi dan Aransemen' => [
                    [
                        'materiName' => 'Menulis Lagu Sendiri',
                        'articleName' => 'Langkah Awal Komposisi Lagu',
                        'articleText' => 'Mulai membuat melodi dan lirik sederhana dari ide pribadi.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menulis Lagu Sendiri 2',
                        'articleName' => 'Membangun Struktur Lagu',
                        'articleText' => 'Pelajari bagian verse, chorus, dan bridge dalam lagu.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menulis Lagu Sendiri 3',
                        'articleName' => 'Menulis Lirik yang Menyentuh',
                        'articleText' => 'Teknik menciptakan lirik yang punya makna dan emosi.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Aransemen Lagu',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Aransemen Lagu Populer',
                        'vblDesc' => 'Teknik menata ulang lagu agar lebih menarik dan harmonis.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],

                'Minggu 4: Performance Project' => [
                    [
                        'materiName' => 'Latihan Panggung',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Persiapan Konser Mini',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Gestur Panggung Profesional',
                        'vblDesc' => 'Pelajari ekspresi tubuh dan interaksi dengan audiens.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Band Ensemble',
                        'vblDesc' => 'Simulasi latihan bersama pemain band untuk penampilan live.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 4',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Evaluasi Penampilan',
                        'vblDesc' => 'Analisis performa untuk peningkatan di penampilan berikutnya.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],
            ],

            // 📷 SENI FOTOGRAFI
            'Seni Fotografi' => [
                'Minggu 1: Dasar Kamera dan Pencahayaan' => [
                    [
                        'materiName' => 'Memahami Exposure',
                        'articleName' => 'Mengenal Segitiga Exposure',
                        'articleText' => 'Pelajari hubungan antara ISO, aperture, dan shutter speed untuk hasil foto ideal.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Pencahayaan',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Pencahayaan Dasar untuk Fotografer Pemula',
                        'vblDesc' => 'Belajar lighting alami dan buatan untuk berbagai kondisi pemotretan.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Memahami Exposure 2',
                        'articleName' => 'Membaca Histogram Foto',
                        'articleText' => 'Cara memahami eksposur dengan bantuan histogram pada kamera atau software editing.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Pencahayaan 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Lighting Studio Sederhana',
                        'vblDesc' => 'Gunakan lampu rumah untuk hasil foto yang dramatis dan profesional.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],

                'Minggu 2: Komposisi Visual' => [
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines',
                        'articleName' => 'Komposisi Visual untuk Pemula',
                        'articleText' => 'Mempelajari dasar-dasar penataan elemen dalam foto agar lebih estetis.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 2',
                        'articleName' => 'Mengenal Framing dan Simetri',
                        'articleText' => 'Gunakan elemen lingkungan untuk membingkai subjek dan menciptakan keseimbangan visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 3',
                        'articleName' => 'Menangkap Perspektif Unik',
                        'articleText' => 'Eksperimen dengan angle dan depth of field untuk hasil yang menarik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 4',
                        'articleName' => 'Panduan Visual Storytelling',
                        'articleText' => 'Belajar menyampaikan cerita melalui komposisi dan pencahayaan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],

                'Minggu 3: Fotografi Potret & Lanskap' => [
                    [
                        'materiName' => 'Teknik Potret Manusia',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Panduan Fotografi Potret',
                        'vblDesc' => 'Pelajari posing dan ekspresi untuk hasil potret yang natural.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Potret Manusia 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Membentuk Mood dalam Potret',
                        'vblDesc' => 'Gunakan pencahayaan dan warna untuk menonjolkan karakter subjek.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Potret Manusia 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Fotografi Lanskap Dramatis',
                        'vblDesc' => 'Mengenal cara mengambil foto lanskap dengan komposisi yang kuat.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],

                'Minggu 4: Editing & Portofolio' => [
                    [
                        'materiName' => 'Basic Editing dengan Lightroom',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Edit Warna dan Kontras',
                        'vblDesc' => 'Panduan menyeimbangkan tone dan pencahayaan untuk hasil maksimal.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Basic Editing dengan Lightroom 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Retouching Foto Potret',
                        'vblDesc' => 'Teknik dasar mengedit kulit dan warna tanpa kehilangan naturalitas.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menyusun Portofolio Fotografi',
                        'articleName' => 'Strategi Membangun Portofolio Profesional',
                        'articleText' => 'Tips menyusun portofolio foto yang menarik untuk klien dan lomba.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
            ],
        ];

        foreach (CourseWeek::all() as $week) {
            $courseType = $week->course->courseType;
            $weekName = $week->weekName;

            if (isset($materis[$courseType][$weekName])) {
                foreach ($materis[$courseType][$weekName] as $item) {
                    CourseMateri::create([
                        'weekId' => $week->id,
                        'materiName' => $item['materiName'], 
                        'articleName' => $item['articleName'],
                        'articleText' => $item['articleText'],
                        'vblName' => $item['vblName'],
                        'vblDesc' => $item['vblDesc'],
                        'vblUrl' => $item['vblUrl'],
                        'duration' =>$item['duration']
                    ]);
                }
            }
        };

    }
}

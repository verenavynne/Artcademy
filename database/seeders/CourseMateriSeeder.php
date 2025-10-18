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
                        'vblName' => 'Video Art Awal',
                        'vblDesc' => 'Cara brainstorming ide secara efektif',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 20
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 2',
                        'articleName' => 'Pengantar Concept Art',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 3',
                        'articleName' => 'Pengantar Concept Art',
                        'articleText' => 'Pelajari peran concept art dalam industri game dan film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Apa itu Concept Art? 4',
                        'articleName' => 'Pengantar Concept Art',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Pelajari dasar proporsi tubuh manusia',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian',
                        'articleName' => 'Desain Karakter Hidup',
                        'articleText' => 'Cara menampilkan kepribadian karakter melalui desain visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 2',
                        'articleName' => 'Desain Karakter Hidup',
                        'articleText' => 'Cara menampilkan kepribadian karakter melalui desain visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 3',
                        'articleName' => 'Desain Karakter Hidup',
                        'articleText' => 'Cara menampilkan kepribadian karakter melalui desain visual.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Ekspresi dan Kepribadian 4',
                        'articleName' => 'Desain Karakter Hidup',
                        'articleText' => 'Cara menampilkan kepribadian karakter melalui desain visual.',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Dasar perspektif untuk environment design',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                     [
                        'materiName' => 'Mood Board: Cara Cari Referensi Efisien',
                        'articleName' => 'Mood Board Guide',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik speed painting dengan gaya fantasi/sci-fi',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Prop Design (Senjata, Kendaraan) yang Fungsional',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Merancang prop yang fungsional dan menarik secara visual',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                ],
                'Minggu 4: Projek Akhir' => [
                    [
                        'materiName' => 'Menyusun Karya Akhir',
                        'articleName' => 'Final Art Composition',
                        'articleText' => 'Langkah-langkah menyusun karya concept art final.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Presentasi Portofolio',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Tips membuat portofolio profesional',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Latihan dasar fleksibilitas dan kekuatan tubuh.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo',
                        'articleName' => 'Teori Ritme dalam Tari',
                        'articleText' => 'Penjelasan tentang sinkronisasi gerak dan musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo 2',
                        'articleName' => 'Teori Ritme dalam Tari',
                        'articleText' => 'Penjelasan tentang sinkronisasi gerak dan musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Irama dan Tempo 3',
                        'articleName' => 'Teori Ritme dalam Tari',
                        'articleText' => 'Penjelasan tentang sinkronisasi gerak dan musik.',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Saman',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Kpop',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Gerak Tari Barat',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Koreografi dan Improvisasi' => [
                    [
                        'materiName' => 'Menyusun Pola Gerak',
                        'articleName' => 'Koreografi Dasar',
                        'articleText' => 'Panduan menyusun urutan gerak untuk pertunjukan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Improvisasi di Atas Panggung',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik improvisasi penari profesional.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                     [
                        'materiName' => 'Menyusun Pola Gerak 2',
                        'articleName' => 'Koreografi Dasar',
                        'articleText' => 'Panduan menyusun urutan gerak untuk pertunjukan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                     [
                        'materiName' => 'Menyusun Pola Gerak 3',
                        'articleName' => 'Koreografi Dasar',
                        'articleText' => 'Panduan menyusun urutan gerak untuk pertunjukan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                     [
                        'materiName' => 'Menyusun Pola Gerak 4',
                        'articleName' => 'Koreografi Dasar',
                        'articleText' => 'Panduan menyusun urutan gerak untuk pertunjukan.',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Simulasi penampilan penuh di panggung.',
                        'vblUrl' => 'https://youtu.be/5iLq3Jme3qE?si=u2PfgYR33IvXXTz2',
                        'duration' => 10
                    ],
                ],
            ],

            // 🎵 SENI MUSIK
            'Seni Musik' => [
                'Minggu 1: Teori Musik Dasar' => [
                    [
                        'materiName' => 'Nada dan Skala',
                        'articleName' => 'Pengenalan Teori Musik',
                        'articleText' => 'Belajar interval, chord, dan tangga nada.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 2',
                        'articleName' => 'Pengenalan Teori Musik',
                        'articleText' => 'Belajar interval, chord, dan tangga nada.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 3',
                        'articleName' => 'Pengenalan Teori Musik',
                        'articleText' => 'Belajar interval, chord, dan tangga nada.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 4',
                        'articleName' => 'Pengenalan Teori Musik',
                        'articleText' => 'Belajar interval, chord, dan tangga nada.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Nada dan Skala 5',
                        'articleName' => 'Pengenalan Teori Musik',
                        'articleText' => 'Belajar interval, chord, dan tangga nada.',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Vokal Dasar 4',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Komposisi dan Aransemen' => [
                      [
                        'materiName' => 'Menulis Lagu Sendiri',
                        'articleName' => 'Langkah Awal Komposisi Musik',
                        'articleText' => 'Cara membuat lirik dan melodi sederhana.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menulis Lagu Sendiri 2',
                        'articleName' => 'Langkah Awal Komposisi Musik',
                        'articleText' => 'Cara membuat lirik dan melodi sederhana.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Menulis Lagu Sendiri 3',
                        'articleName' => 'Langkah Awal Komposisi Musik',
                        'articleText' => 'Cara membuat lirik dan melodi sederhana.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Aransemen Lagu',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Teknik menata ulang lagu agar lebih menarik.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],
                'Minggu 4: Performance Project' => [
                    [
                        'materiName' => 'Latihan Panggung',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Latihan Panggung 4',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
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
                        'articleName' => 'Panduan Exposure',
                        'articleText' => 'Mengenal ISO, aperture, dan shutter speed.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Pencahayaan',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Belajar lighting alami dan buatan.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Memahami Exposure 2',
                        'articleName' => 'Panduan Exposure',
                        'articleText' => 'Mengenal ISO, aperture, dan shutter speed.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Pencahayaan 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Belajar lighting alami dan buatan.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],
                'Minggu 2: Komposisi Visual' => [
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines',
                        'articleName' => 'Panduan Komposisi',
                        'articleText' => 'Cara menyusun foto agar lebih menarik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 2',
                        'articleName' => 'Panduan Komposisi',
                        'articleText' => 'Cara menyusun foto agar lebih menarik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 3',
                        'articleName' => 'Panduan Komposisi',
                        'articleText' => 'Cara menyusun foto agar lebih menarik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Rule of Thirds dan Leading Lines 4',
                        'articleName' => 'Panduan Komposisi',
                        'articleText' => 'Cara menyusun foto agar lebih menarik.',
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
                        'vblName' => 'Video',
                        'vblDesc' => 'Posing dan ekspresi dalam fotografi potret.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Potret Manusia 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Posing dan ekspresi dalam fotografi potret.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Teknik Potret Manusia 3',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Posing dan ekspresi dalam fotografi potret.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],
                'Minggu 4: Editing & Portofolio' => [
                    [
                        'materiName' => 'Basic Editing dengan Lightroom',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Edit foto profesional dengan warna seimbang.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Basic Editing dengan Lightroom 2',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Edit foto profesional dengan warna seimbang.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'materiName' => 'Basic Editing dengan Lightroom',
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video',
                        'vblDesc' => 'Edit foto profesional dengan warna seimbang.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
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
        }
    }
}

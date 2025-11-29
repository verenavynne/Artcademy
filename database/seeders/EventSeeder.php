<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $workshopTemplates = [
            [
                'eventName' => 'Workshop: Dasar Fotografi',
                'eventDesc' => 'Pelajari teknik dasar fotografi seperti komposisi, lighting, dan penggunaan lensa.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 180,
                'eventPrice' => 250000,
            ],
            [
                'eventName' => 'Workshop: Seni Lukis Acrylic',
                'eventDesc' => 'Belajar membuat lukisan acrylic dari awal hingga selesai, cocok untuk pemula.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 150,
                'eventPrice' => 300000,
            ],
            [
                'eventName' => 'Workshop: Intro to UI/UX Design',
                'eventDesc' => 'Pengenalan konsep UI/UX serta praktik membuat wireframe dan user flow.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 120,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Workshop: Dasar Digital Marketing',
                'eventDesc' => 'Belajar SEO, content marketing, dan strategi social media.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 180,
                'eventPrice' => 200000,
            ],
            [
                'eventName' => 'Workshop: Public Speaking for Beginners',
                'eventDesc' => 'Pelajari teknik dasar berbicara di depan umum dengan percaya diri.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 120,
                'eventPrice' => 220000,
            ],
            [
                'eventName' => 'Workshop: Basic Cooking Class',
                'eventDesc' => 'Belajar memasak hidangan sederhana namun lezat bersama chef profesional.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 150,
                'eventPrice' => 280000,
            ],
            [
                'eventName' => 'Workshop: Creative Writing',
                'eventDesc' => 'Belajar menulis cerita yang menarik dan menyentuh emosi pembaca.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 120,
                'eventPrice' => 180000,
            ],
            [
                'eventName' => 'Workshop: Handmade Craft & DIY',
                'eventDesc' => 'Bikin kerajinan tangan unik dari bahan sederhana.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 180,
                'eventPrice' => 230000,
            ],
        ];

        $webinarTemplates = [
            [
                'eventName' => 'Webinar: Belajar Desain Grafis Dasar',
                'eventDesc' => 'Belajar desain grafis memakai Canva & Adobe Illustrator.',
                'eventPlace' => 'https://zoom.us/j/111222333',
                'eventDuration' => 90,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Webinar: Personal Branding di Era Digital',
                'eventDesc' => 'Cara membangun personal branding yang kuat di dunia digital.',
                'eventPlace' => 'https://zoom.us/j/222333444',
                'eventDuration' => 60,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Webinar: Career Guide for Fresh Graduates',
                'eventDesc' => 'Panduan membuat CV, portofolio, dan tips interview.',
                'eventPlace' => 'https://zoom.us/j/333444555',
                'eventDuration' => 75,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Webinar: Dasar Web Development',
                'eventDesc' => 'Belajar HTML, CSS, dan JavaScript untuk pemula.',
                'eventPlace' => 'https://zoom.us/j/444555666',
                'eventDuration' => 120,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Webinar: Belajar AI untuk Pemula',
                'eventDesc' => 'Pengenalan machine learning dan cara memanfaatkan AI.',
                'eventPlace' => 'https://zoom.us/j/555666777',
                'eventDuration' => 90,
                'eventPrice' => 100000,
            ],
            [
                'eventName' => 'Webinar: Manajemen Waktu & Produktivitas',
                'eventDesc' => 'Strategi meningkatkan produktivitas secara efektif.',
                'eventPlace' => 'https://zoom.us/j/666777888',
                'eventDuration' => 60,
                'eventPrice' => 350000,
            ],
            [
                'eventName' => 'Webinar: Dasar Editing Video',
                'eventDesc' => 'Belajar editing video memakai CapCut dan Premiere Pro.',
                'eventPlace' => 'https://zoom.us/j/777888999',
                'eventDuration' => 120,
                'eventPrice' => 150000,
            ],
            [
                'eventName' => 'Webinar: Pengembangan Diri untuk Mahasiswa',
                'eventDesc' => 'Bangun mindset positif dan tingkatkan skill diri.',
                'eventPlace' => 'https://zoom.us/j/888999000',
                'eventDuration' => 90,
                'eventPrice' => 350000,
            ],
        ];

        // Insert Workshops
        foreach ($workshopTemplates as $i => $item) {
            Event::create([
                'eventCategory' => 'Workshop',
                'eventName'     => $item['eventName'],
                'eventDesc'     => $item['eventDesc'],
                'eventDate'     => Carbon::now()->addDays($i + 1),
                'eventDuration' => $item['eventDuration'],
                'start_time'    => '09:00:00',
                'eventPlace'    => $item['eventPlace'],
                'eventPrice'    => $item['eventPrice'],
                'eventSlot'     => rand(20, 100),
                'eventBanner'   => 'assets/event_template.jpg',
            ]);
        }

        
        foreach ($webinarTemplates as $i => $item) {
            Event::create([
                'eventCategory' => 'Webinar',
                'eventName'     => $item['eventName'],
                'eventDesc'     => $item['eventDesc'],
                'eventDate'     => Carbon::now()->addDays($i + 10),
                'eventDuration' => $item['eventDuration'],
                'start_time'    => '13:00:00',
                'eventPlace'    => $item['eventPlace'], 
                'eventPrice'    => $item['eventPrice'],
                'eventSlot'     => rand(50, 200),
                'eventBanner'   => 'assets/event_template.jpg',
            ]);
        }
    }
}

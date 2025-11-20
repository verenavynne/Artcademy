<?php

namespace Database\Seeders;

use App\Models\Chatbot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chatbot::create([
            'chatbotName' => 'Apollo',
            'chatbotMascot' => 'assets/icons/icon_apollo.svg'
        ]);
    }
}

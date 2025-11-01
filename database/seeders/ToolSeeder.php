<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            // 🎨 Seni Lukis & Digital Art
            [
                'toolsName' => 'Procreate',
                'toolsPicture' => 'assets/tools/procreate.png',
                'toolsType' => 'Seni Lukis & Digital Art',
            ],
            [
                'toolsName' => 'Adobe Photoshop',
                'toolsPicture' => 'assets/tools/adobe_photoshop.png',
                'toolsType' => 'Seni Lukis & Digital Art',
            ],

            // 💃 Seni Tari
            [
                'toolsName' => 'Dance Shoes',
                'toolsPicture' => 'assets/tools/dance_shoes.jpg',
                'toolsType' => 'Seni Tari',
            ],

            // 🎵 Seni Musik
            [
                'toolsName' => 'Guitar',
                'toolsPicture' => 'assets/tools/guitar.jpg',
                'toolsType' => 'Seni Musik',
            ],
            [
                'toolsName' => 'Keyboard',
                'toolsPicture' => 'assets/tools/keyboard.jpg',
                'toolsType' => 'Seni Musik',
            ],

            // 📸 Seni Fotografi
            [
                'toolsName' => 'DSLR Camera',
                'toolsPicture' => 'assets/tools/dslr_camera.jpg',
                'toolsType' => 'Seni Fotografi',
            ],
            [
                'toolsName' => 'Tripod',
                'toolsPicture' => 'assets/tools/tripod.jpg',
                'toolsType' => 'Seni Fotografi',
            ],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        };

    }
}

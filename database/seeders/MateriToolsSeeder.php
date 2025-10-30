<?php

namespace Database\Seeders;

use App\Models\CourseMateri;
use App\Models\MateriTool;
use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toolsByType = Tool::all()->groupBy('toolsType');

        $materis = CourseMateri::with('week.course')->get();

        foreach ($materis as $materi) {
            $courseType = $materi->week->course->courseType ?? null;
            if (!$courseType || !isset($toolsByType[$courseType])) {
                continue; 
            }

            $tools = $toolsByType[$courseType];

            foreach ($tools as $tool) {
                MateriTool::firstOrCreate([
                    'materiId' => $materi->id,
                    'toolId'   => $tool->id,
                ]);
            }
        };


    }
}

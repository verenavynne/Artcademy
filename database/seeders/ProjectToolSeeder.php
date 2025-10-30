<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTool;
use App\Models\Tool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $tools = Tool::all();

       

        foreach ($projects as $project) {
            $randomTools = $tools->random(rand(1, min(2, $tools->count())));

            foreach ($randomTools as $tool) {
                ProjectTool::firstOrCreate([
                    'projectId' => $project->id,
                    'toolId'    => $tool->id,
                ]);
            }
        }
    }
}

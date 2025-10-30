<?php

namespace Database\Seeders;

use App\Models\GradeCriteria;
use App\Models\Project;
use App\Models\ProjectCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $criterias = GradeCriteria::all();

        foreach ($projects as $project) {
            foreach ($criterias as $criteria) {
                ProjectCriteria::firstOrCreate([
                    'projectId'  => $project->id,
                    'criteriaId' => $criteria->id,
                ], [
                    'score' => rand(50, 100), 
                ]);
            }
        }
    }
}

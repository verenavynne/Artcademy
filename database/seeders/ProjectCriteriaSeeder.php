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
            $weights = $this->generateWeights($criterias->count());

            foreach ($criterias as $index => $criteria) {
                ProjectCriteria::firstOrCreate([
                        'projectId'  => $project->id,
                        'criteriaId' => $criteria->id,
                    ],[
                        'customWeight' => $weights[$index],
                    ]);
            }
        }
    }

    private function generateWeights(int $count): array
    {
        $total = 100;
        $weights = [];

        for ($i = 0; $i < $count - 1; $i++) {
            $max = ($total / 10 - ($count - $i - 1)) * 10;
            $value = rand(1, $max / 10) * 10;

            $weights[] = $value;
            $total -= $value;
        }

        $weights[] = $total;
        shuffle($weights);

        return $weights;
    }
}

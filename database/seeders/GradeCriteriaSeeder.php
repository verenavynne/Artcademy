<?php

namespace Database\Seeders;

use App\Models\GradeCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GradeCriteria::create([
            'criteriaName' => 'Kreativitas',
            'criteriaWeight' => 30
        ]);

        GradeCriteria::create([
            'criteriaName' => 'Keterbacaan',
            'criteriaWeight' => 20
        ]);

        GradeCriteria::create([
            'criteriaName' => 'Kesesuaian Tema',
            'criteriaWeight' => 50
        ]);
    }
}

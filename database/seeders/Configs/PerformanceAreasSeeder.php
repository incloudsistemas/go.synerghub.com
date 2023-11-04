<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\PerformanceArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformanceAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PerformanceArea::factory(10)->create();
    }
}

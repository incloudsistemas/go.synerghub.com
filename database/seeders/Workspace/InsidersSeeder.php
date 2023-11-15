<?php

namespace Database\Seeders\Workspace;

use App\Models\Configs\Cnae;
use App\Models\Configs\PerformanceArea;
use App\Models\Workspace\Insider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Insider::factory()
            ->count(10)
            ->create()
            ->each(function ($insider) {
                $cnaes = Cnae::inRandomOrder()
                    ->take(3)
                    ->get();

                $insider->secondaryCnaes()
                    ->attach($cnaes->pluck('id'));

                $performanceAreas = PerformanceArea::inRandomOrder()
                    ->take(3)
                    ->get();

                $insider->performanceAreas()
                    ->attach($performanceAreas->pluck('id'));
            });
    }
}

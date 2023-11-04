<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\EconomicCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EconomicCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EconomicCategory::factory(10)->create();
    }
}

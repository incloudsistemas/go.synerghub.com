<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\Cnae;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CnaesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cnae::factory(10)->create();
    }
}

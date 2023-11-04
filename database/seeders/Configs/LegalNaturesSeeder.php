<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\LegalNature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LegalNaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LegalNature::factory(10)->create();
    }
}

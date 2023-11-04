<?php

namespace Database\Seeders\Configs;

use App\Models\Configs\CorporateQualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorporateQualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CorporateQualification::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Configs\CnaesSeeder;
use Database\Seeders\Configs\CorporateQualificationsSeeder;
use Database\Seeders\Configs\EconomicCategoriesSeeder;
use Database\Seeders\Configs\LegalNaturesSeeder;
use Database\Seeders\Configs\PerformanceAreasSeeder;
use Database\Seeders\Workspace\ContactsSeeder;
use Database\Seeders\Workspace\InsidersSeeder;
use Database\Seeders\Workspace\ProductsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,

            ContactsSeeder::class,

            CnaesSeeder::class,
            LegalNaturesSeeder::class,
            EconomicCategoriesSeeder::class,
            CorporateQualificationsSeeder::class,
            PerformanceAreasSeeder::class,

            InsidersSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}

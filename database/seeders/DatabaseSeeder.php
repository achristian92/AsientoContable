<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PensionSeeder::class,
            HeaderSeeder::class,
            //CsvCostSeeder::class,
            //CsvCost2Seeder::class,
            //CsvAccountSeeder::class,
            //CsvHeaderSeeder::class,
            //CsvPensionSeeder::class,
            //CustomerSeeder::class,
        ]);
    }
}

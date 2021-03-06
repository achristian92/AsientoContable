<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pensions = collect([
            [
                'short'=> 'IN',
                'name'=> 'AFP INTEGRA',
            ],
            [
                'short'=> 'HA',
                'name'=> 'AFP HABITAT',
            ],
            [
                'short'=> 'PR',
                'name'=> 'AFP PROFUTURO',
            ],
            [
                'short'=> 'PM',
                'name'=> 'AFP PRIMA',
            ],
            [
                'short'=> 'ON',
                'name'=> 'ONP',
            ],
        ]);
        $pensions->each(function ($pension) {
            \App\AsientoContable\Base\BasePension::create($pension);
        });
    }
}

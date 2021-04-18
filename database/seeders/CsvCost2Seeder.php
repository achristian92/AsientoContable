<?php

namespace Database\Seeders;

use DB;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;

class CsvCost2Seeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'costs2';
        $this->filename = base_path().'/database/seeders/csvs/cost2.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}

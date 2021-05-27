<?php

namespace Database\Seeders;

use DB;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CsvCostSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'costs';
        $this->filename = base_path().'/database/seeders/csvs/cost.csv';
    }

    public function run()
    {
        Log::info("load seeder costs");
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}

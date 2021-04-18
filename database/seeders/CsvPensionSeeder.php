<?php

namespace Database\Seeders;

use DB;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;

class CsvPensionSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'pension_fund';
        $this->filename = base_path().'/database/seeders/csvs/pensions.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}

<?php

namespace Database\Seeders;

use DB;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;

class CsvHeaderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'headers';
        $this->filename = base_path().'/database/seeders/csvs/headers.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}

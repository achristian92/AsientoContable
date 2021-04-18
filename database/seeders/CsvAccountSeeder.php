<?php

namespace Database\Seeders;

use DB;
use Flynsarmy\CsvSeeder\CsvSeeder;

class CsvAccountSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'account_plan';
        $this->filename = base_path().'/database/seeders/csvs/accounts.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DicRegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sSQL = file_get_contents(database_path('dic_regions.sql'));
        DB::unprepared($sSQL);
    }
}

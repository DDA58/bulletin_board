<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DicCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sSQL = file_get_contents(database_path('dic_cities.sql'));
        DB::unprepared($sSQL);
    }
}

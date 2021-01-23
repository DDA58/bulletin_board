<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Adverts;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(DicRegionsTableSeeder::class);
        $this->call(DicCitiesTableSeeder::class);
        $this->call(AdCategoriesTableSeeder::class);
        Adverts::factory()->count(100)->create();
    }
}

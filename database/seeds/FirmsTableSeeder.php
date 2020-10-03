<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FirmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('firms')->insert([
            'name' => 'Waterfree',
            'slug' => 'waterfree',
            'logo' => '/public/images/firm_default.svg'
        ]);

        DB::table('city_firms')->insert([
            'city_id' => 1,
            'firms_id' => 1,
        ]);
    }
}

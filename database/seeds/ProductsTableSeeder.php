<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Вода',
            'slug' => 'voda',
            'description' => 'Описание',
            'logo' => '/images/logo_products/default.png',
            'price' => '190',
            'liter' => '19',
            'hit' => 1,
            'city_id' => '1',
            'firm_id' => '1'
        ]);

        DB::table('products')->insert([
            'name' => 'Вода 2',
            'slug' => 'voda-2',
            'description' => 'Описание',
            'logo' => '/images/logo_products/default.png',
            'price' => '120',
            'liter' => '19',
            'hit' => 1,
            'city_id' => '1',
            'firm_id' => '1'
        ]);

        DB::table('products')->insert([
            'name' => 'Вода 3',
            'slug' => 'voda-3',
            'description' => 'Описание',
            'logo' => '/images/logo_products/default.png',
            'price' => '100',
            'liter' => '19',
            'hit' => 1,
            'city_id' => '1',
            'firm_id' => '1'
        ]);
    }
}

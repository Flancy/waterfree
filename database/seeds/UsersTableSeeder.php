<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'activate' => 1,
            'role' => 0,
            'email' => 'flancyk.flancyk@yandex.ru',
            'password' => bcrypt('klon5031'),
            'phone' => '+7(999)-999-99-99',
            'city_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'activate' => 1,
            'role' => 2,
            'email' => 'flancyk.flancyk1@yandex.ru',
            'password' => bcrypt('klon5031'),
            'phone' => '+7(999)-999-99-98',
            'city_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'activate' => 1,
            'role' => 1,
            'email' => 'flancyk.flancyk2@yandex.ru',
            'password' => bcrypt('klon5031'),
            'phone' => '+7(999)-999-99-97',
            'city_id' => 1,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1
        ]);
        DB::table('balances')->insert([
            'user_id' => 2
        ]);
        DB::table('balances')->insert([
            'user_id' => 3
        ]);
    }
}

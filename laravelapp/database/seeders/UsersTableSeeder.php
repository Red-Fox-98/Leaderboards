<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Red Fox',
            'email' => 'red_fox@mail.ru',
            'password' => bcrypt('123abc321'),
        ];

        \DB::table('users')->insert($data);
    }
}

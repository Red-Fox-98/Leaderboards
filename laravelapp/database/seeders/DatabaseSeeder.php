<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Session;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create(['name' => 'admin']);
        Role::factory()->create(['name' => 'player']);

        User::factory()->create(
            [
                'email' => 'admin@test.com',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('admin')]);

        User::factory()->create(
            [
                'email' => 'red_____fox@mail.ru',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('player')]);

        User::factory()->create(
            [
                'email' => 'red____fox@mail.ru',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('player')]);

        User::factory()->create(
            [
                'email' => 'red___fox@mail.ru',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('player')]);

        User::factory()->create(
            [
                'email' => 'red__fox@mail.ru',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('player')]);

        User::factory()->create(
            [
                'email' => 'red_fox@mail.ru',
                'password' => bcrypt('password')
            ]
        )->assignRole([Role::findByName('player')]);
    }
}

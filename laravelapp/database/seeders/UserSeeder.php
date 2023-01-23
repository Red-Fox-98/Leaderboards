<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(
            [
                'email' => 'admin@test.com',
                'password' => bcrypt('password')
            ]
        )->assignRole(Role::ADMIN);

        $users = User::factory()->times(5)->create(
            ['password' => bcrypt('password')]
        );
        foreach ($users as $user) {
            $user->assignRole(Role::PLAYER);
        }
    }
}

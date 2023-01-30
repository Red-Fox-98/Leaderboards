<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator;
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
        /** @var User $admin */
        $admin = User::factory()->create(
            [
                'email' => 'admin@test.com',
                'password' => bcrypt('password')
            ]
        );

        Player::factory()->create(['user_id' => $admin->id]);

        $admin->assignRole(Role::ADMIN);

        /** @var Player $player */
        $player = User::factory()->create();

        Player::factory()->create(['user_id' => $player->id]);
        $player->assignRole(Role::PLAYER);

    }
}

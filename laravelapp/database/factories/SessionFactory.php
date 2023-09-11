<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var Player $player */
        $player = Player::query()->inRandomOrder()->first();

        if (!$player){
            $player = Player::factory()->create();
            $player->user->assignRole(Role::PLAYER);
        }

        return [
            'player_id'=> $player->id,
            'map_name' => $this->faker->word,
            'score' => $this->faker->numberBetween(0,1000),
            'session_duration' => $this->faker->numberBetween(0,1800),
        ];
    }
}

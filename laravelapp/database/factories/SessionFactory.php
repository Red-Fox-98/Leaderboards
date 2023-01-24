<?php

namespace Database\Factories;

use App\Models\Player;
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
        return [
            'player_id'=> Player::query()->inRandomOrder()->first()->id,
            'map_name' => $this->faker->word,
            'score' => $this->faker->biasedNumberBetween(0,1000),
            'session_duration' => $this->faker->biasedNumberBetween(0,1800),
            'is_record' => $this->faker->boolean,
        ];
    }
}

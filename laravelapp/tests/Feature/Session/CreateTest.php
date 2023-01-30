<?php

namespace Tests\Feature\Session;

use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use WithFaker;
    public function testSessionCreationWasSuccessful()
    {
        $password = 'password';
        /** @var User $user */
        $user = User::factory()->create([
            'email' => $this->faker->unique()->email,
            'password' => bcrypt($password),
        ]);

        /** @var Player $player */
        $player = Player::factory()->create([
            'user_id' => $user->id,
            'nickname' => $this->faker->unique()->word,
        ]);

        $data = [
            'map_name' => $this->faker->word(),
            'score' => $this->faker->numberBetween(0, 1000),
            'session_duration' => $this->faker->numberBetween(0, 1800),
        ];

        $this->actingAs($user)->json('post', route('api.session.create'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'status', 'success',
                'data' => ['id'],
            ]);
    }
}

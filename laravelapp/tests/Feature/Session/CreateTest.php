<?php

namespace Tests\Feature\Session;

use App\Models\Player;
use App\Models\User;
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
            'data' => ['key_1' => $this->faker->name(),'key_2' => $this->faker->phoneNumber()],
        ];

        $this->actingAs($user)->json('post', route('sessions.create'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'status', 'success',
                'data' => ['id'],
            ]);

        $this->assertDatabaseHas('sessions', [
            'player_id' => $player->id,
            'map_name' => $data['map_name'],
            'score' => $data['score'],
            'session_duration' => $data['session_duration'],
        ]);

        $this->assertDatabaseHas('session_data', [
            'session_id' => $player->session->id,
        ]);
    }
}

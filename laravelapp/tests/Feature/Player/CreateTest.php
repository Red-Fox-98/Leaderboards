<?php

namespace Tests\Feature\Player;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use WithFaker;
    public function testCreatePlayerIsSuccessful()
    {
        $password = 'password';
        /** @var User $user */
        $user = User::factory()->create([
            'email' => $this->faker->unique()->email,
            'password' => bcrypt($password),
        ]);

        $data = [
            'nickname' => $this->faker->unique()->word,
        ];

        $this->actingAs($user)->json('get', route('players.create'), $data)
        ->assertOk()
        ->assertJsonStructure([
            'status', 'success',
            'data' => ['id'],
        ]);

        $this->assertDatabaseHas('players', [
            'nickname' => $data['nickname'],
        ]);
    }
}

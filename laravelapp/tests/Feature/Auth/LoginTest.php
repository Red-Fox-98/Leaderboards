<?php

namespace Tests\Feature\Auth;

use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;

    public function testLoginViaEmailIsSuccessful()
    {
        $password = 'password';
        /** @var User $user */
        $user = User::factory()->create([
            'email' => $this->faker->unique()->email,
            'password' => bcrypt($password),
            ]);

        $player = Player::factory()->create([
           'user_id' => $user->id,
           'nickname' => $this->faker->unique()->userName(),
        ]);

        $data = [
            'nickname' => $player->nickname,
            'email' => $user->email,
            'password' => $password,
        ];

        $this->json('post', route('api.auth.login'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'status', 'success',
                'data' => ['token'],
            ]);
    }
}

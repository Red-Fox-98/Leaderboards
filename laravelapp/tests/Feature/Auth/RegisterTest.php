<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;

    public function testRegisterViaEmailIsSuccessful()
    {
        $data = [
            'email' => $this->faker->unique()->email,
            'password' => 'password',
        ];

        $this->json('post', route('api.auth.register'), $data)
            ->assertOk()
            ->assertJsonStructure([
                'status', 'success',
                'data' => ['token'],
            ]);


        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }
}

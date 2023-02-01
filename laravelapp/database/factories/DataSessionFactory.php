<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSession>
 */
class DataSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /** @var Session $session */
        $session = Session::query()->inRandomOrder()->first();

        if (!$session){
            $session = Session::factory()->create();
        }

        return [
            'session_id'=> $session->id,
            'data' => json_encode(['key_1' => $this->faker->name(),'key_2' => $this->faker->phoneNumber()]),
        ];
    }
}

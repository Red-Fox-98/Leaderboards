<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $file = UploadedFile::fake()->image("1",30,30);
        $path = \Storage::disk('public')->putFile('/images', $file);
        return [
            'user_id' => rand(1, 100),
            'model_id' => rand(1, 100),
            'path' => $path,
            'name' => $this->faker->word,
            'type' => $this->faker->word,
            'extension' => $this->faker->word,
            'size' => rand(50, 75),
            'published_at' => $this->faker->dateTimeBetween('-2 months', '-1 days')
        ];
    }
}

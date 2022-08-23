<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use App\Models\User;

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
        $file = UploadedFile::fake()->image("i.png", 30, 30);
        $path = \Storage::disk('public')->putFile('/images', $file);
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'path' => $path,
        ];
    }
}

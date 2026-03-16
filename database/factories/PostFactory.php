<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            '1.jfif', '2.jfif', '3.jfif', '4.jfif', '5.jfif', '6.jfif', '7.jfif', '8.jfif', '9.jfif', '10.jfif',
            '11.jfif', '12.jfif', '13.jfif', '14.jfif', '15.jfif', '16.jfif', '17.jfif', '18.jfif', '19.jfif', '20.jfif',
            '21.jfif', '22.jfif',
        ];
        return [
            'description' => fake()->sentence(),
            'slug' => Str::slug(fake()->sentence(6)),
            'image' => 'posts/'.fake()->randomElement($images),
            'user_id' => User::factory(),
        ];
    }
}

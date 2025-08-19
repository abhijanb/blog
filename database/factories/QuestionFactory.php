<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Blog;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(),
            'blog_id' => Blog::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'is_published' => $this->faker->boolean(80),
        ];
    }
}

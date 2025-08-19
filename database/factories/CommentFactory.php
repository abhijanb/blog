<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Blog;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'parent_id' => null, // or could randomly pick a previous comment
            'comment_text' => $this->faker->sentence(),
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Models\FaqCategory;
use App\Models\Faq;
use App\Models\Question;
use App\Models\Service;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Users
        User::factory(5)->create();

        // Blog Categories
        BlogCategory::factory(5)->create();

        // Blogs
        Blog::factory(5)->create();

        // Comments
        Comment::factory(5)->create();

        // Likes
        Like::factory(5)->create();

        // FAQ Categories
        FaqCategory::factory(5)->create();

        // FAQs
        Faq::factory(5)->create();

        // Questions
        Question::factory(5)->create();

        // Services
        Service::factory(5)->create();
    }
}

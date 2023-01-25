<?php

namespace Database\Seeders;

use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();

        $blogCount = (int)$this->command->ask('How many blog posts would you like?', 50);

        BlogPosts::factory($blogCount)->make()->each(function($post) use($users) {
        $post->user_id = $users->random()->id;
         $post->save();

    });
    }
}
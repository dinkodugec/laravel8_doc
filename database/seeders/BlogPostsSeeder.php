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

        BlogPosts::factory(50)->make()->each(function($post) use($users) {
        $post->user_id = $users->random()->id;
         $post->save();

    });
    }
}

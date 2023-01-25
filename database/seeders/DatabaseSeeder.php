<?php

namespace Database\Seeders;

use App\Models\BlogPosts;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
/* use Illuminate\Support\Facades\DB; */
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
      /*   DB::table('users')->insert([
            'name' => 'Dinko Dugc',
            'email' => 'dinko@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(10),
        ]); this is random bx new Laravel APP */

       $dinko = User::factory()->defaultUser()->create();

        $else = User::factory(20)->create();

        $posts = BlogPosts::factory(20)->create();

      $users = $else->concat([$dinko]);



      BlogPosts::factory(50)->make()->each(function($post) use($users) {
        $post->user_id = $users->random()->id;
         $post->save();
      
    });

       Comment::factory(50)->make()->each(function ($comment) use ($posts) {
        $comment->blog_posts_id = $posts->random()->id;
        $comment->save();
    });
    }



}

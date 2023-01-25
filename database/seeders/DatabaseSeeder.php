<?php

namespace Database\Seeders;

use App\Models\BlogPosts;
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

      User::factory()->defaultUser()->create();

        User::factory(20)->create();

        BlogPosts::factory(20)->create();


    }



}

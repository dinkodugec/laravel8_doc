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

        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }


         $this->call(UsersTableSeeder::class);
         $this->call(BlogPostsSeeder::class);
         $this->call(CommentsTableSeeder::class);


    }



}
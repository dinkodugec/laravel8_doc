<?php

namespace Database\Factories;

use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostsFactory extends Factory
{

    protected $model = BlogPosts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = collect(User::all()->modelKeys());

        return [
            'title' => $this->faker->title,
            'content' => $this->faker->text,
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
            'user_id'=> $users->random(),


        ];
    }
}
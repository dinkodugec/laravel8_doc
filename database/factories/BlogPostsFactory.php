<?php

namespace Database\Factories;

use App\Models\BlogPosts;
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
        return [
            'title' => $this->faker->title,
            'content' => $this->faker->text,

        ];
    }
}

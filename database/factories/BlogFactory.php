<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Users; 
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(), 
            'title' => $this->faker->sentence(), 
            'description' => $this->faker->paragraph(), 
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'), 
            'author_id' => Users::inRandomOrder()->first()->id,
        ];
    }
}

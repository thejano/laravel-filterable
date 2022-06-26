<?php

namespace TheJano\LaravelFilterable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheJano\LaravelFilterable\Tests\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'published' => rand(0, 1),
        ];
    }
}

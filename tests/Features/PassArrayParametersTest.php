<?php

use TheJano\LaravelFilterable\Tests\Models\Post;

it('Pass Array As Parameter instead of request', function () {
    $filters = [
        'date' => [
            'from' => now()->subMonth()->toDateString(),
            'to' => now()->addDays(6)->toDateString(),
        ],
    ];

    Post::insert([
        ['created_at' => now()->subDays(10)],
        ['created_at' => now()->addDays(10)],
        ['created_at' => now()->addDays(3)],
    ]);

    $posts = Post::filterable($filters);

    $this->assertEquals(2, $posts->count());
});

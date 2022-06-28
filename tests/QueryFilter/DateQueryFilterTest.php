<?php

use Illuminate\Http\Request;
use TheJano\LaravelFilterable\Tests\Models\Post;

it("Assert the the entries between 2 dates using default field", function () {
    $request = new Request([
        'date' => [
            'from' => now()->subMonth()->toDateString(),
            'to' => now()->addDays(6)->toDateString(),
        ],
    ]);

    Post::insert([
        ['created_at' => now()->subDays(10)],
        ['created_at' => now()->addDays(10)],
        ['created_at' => now()->addDays(3)],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals(2, $posts->count());
});


it("Assert the the entries between 2 dates passing a custom field", function () {
    $request = new Request([
        'date' => [
            'fromBYupdated_at' => now()->subMonth()->toDateString(),
            'toBYupdated_at' => now()->addDays(6)->toDateString(),
        ],
    ]);

    Post::insert([
        ['updated_at' => now()->subDays(25)],
        ['updated_at' => now()->addDays(2)],
        ['updated_at' => now()->addDays(5)],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals(3, $posts->count());
});

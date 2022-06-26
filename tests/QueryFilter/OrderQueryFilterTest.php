<?php

use Illuminate\Http\Request;
use TheJano\LaravelFilterable\Tests\Models\Post;

it("Order without field", function () {
    $request = new Request([
        'order' => 'DESC',
    ]);

    Post::insert([
        ['title' => 'Post 1', 'created_at' => now()->addDays(10)],
        ['title' => 'Post 2', 'created_at' => now()->addDays(20)],
        ['title' => 'Post 3', 'created_at' => now()->addDays(3)],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals('Post 2', $posts->first()->title);
});


it("Assert order by id ASC", function () {
    $request = new Request([
        'order' => [
            'id' => 'ASC',
        ],
    ]);

    Post::insert([
        ['title' => 'Post 1'],
        ['title' => 'Post 2'],
        ['title' => 'Post 3'],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals('Post 1', $posts->first()->title);
});



it("Assert order by id DESC", function () {
    $request = new Request([
        'order' => [
            'id' => 'DESC',
        ],
    ]);

    Post::insert([
        ['title' => 'Post 1'],
        ['title' => 'Post 2'],
        ['title' => 'Post 3'],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals('Post 3', $posts->first()->title);
});

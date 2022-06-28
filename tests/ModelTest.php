<?php

use Illuminate\Http\Request;
use TheJano\LaravelFilterable\Tests\Filters\Filterable\PostFilterable;
use TheJano\LaravelFilterable\Tests\Filters\QueryFilter\HasCommentsQueryFilter;
use TheJano\LaravelFilterable\Tests\Models\Post;

it('Pass filterable to the model', function () {
    $request = new Request([
        'published' => 'true',
    ]);

    Post::insert([
        ['published' => true],
        ['published' => true],
        ['published' => false],
        ['published' => true],
    ]);

    $posts = Post::filterable($request);

    $this->assertEquals(3, $posts->count());
});

it('Pass Filterable class as parameter', function () {
    $request = new Request([
        'published' => 'true',
    ]);

    Post::insert([
        ['published' => true],
        ['published' => true],
        ['published' => false],
        ['published' => true],
    ]);

    $posts = Post::filterable($request, PostFilterable::class);

    $this->assertEquals(3, $posts->count());
});

it('Pass additioonal filters as parameter', function () {
    $request = new Request([
        'has_comments' => 'true',
    ]);

    Post::insert([
        ['has_comments' => true],
        ['has_comments' => false],
        ['has_comments' => true],
    ]);

    $posts = Post::filterable($request, PostFilterable::class, [
        'has_comments' => HasCommentsQueryFilter::class,
    ]);

    $this->assertEquals(2, $posts->count());
});

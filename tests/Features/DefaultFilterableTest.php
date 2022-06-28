<?php


use Illuminate\Http\Request;
use TheJano\LaravelFilterable\Tests\Models\Category;

it("Assert the the entries between 2 dates without passing filterClass to model", function () {
    $request = new Request([
        'date' => [
            'from' => now()->subMonth()->toDateString(),
            'to' => now()->addDays(6)->toDateString(),
        ],
    ]);

    Category::insert([
        ['created_at' => now()->subDays(25)],
        ['created_at' => now()->addDays(2)],
        ['created_at' => now()->addDays(5)],
    ]);

    $posts = Category::filterable($request);

    $this->assertEquals(3, $posts->count());
});

<?php

namespace TheJano\LaravelFilterable\Tests\Filters\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;
use TheJano\LaravelFilterable\Tests\Filters\QueryFilter\PublishedQueryFilter;

class PostFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected array $filters = [
        'published' => PublishedQueryFilter::class,
    ];
}

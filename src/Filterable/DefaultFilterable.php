<?php

namespace TheJano\LaravelFilterable\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;
use TheJano\LaravelFilterable\Tests\Filterable\Array;

class DefaultFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected array $filters = [];
}

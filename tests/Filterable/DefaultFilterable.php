<?php

namespace TheJano\LaravelFilterable\Tests\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;

class DefaultFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected array $filters = [];
}

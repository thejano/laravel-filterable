<?php

namespace App\Filters\Filterables;

use App\Filters\Abstracts\FilterableAbstract;
use App\Filters\Interfaces\FilterableInterface;
use App\Filters\QueryFilters\PublishedQueryFilter;

class CategoryFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected $filters = [
        'published' => PublishedQueryFilter::class
    ];
}

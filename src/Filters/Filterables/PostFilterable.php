<?php

namespace App\Filters\Filterables;

use App\Filters\Abstracts\FilterableAbstract;
use App\Filters\Interfaces\FilterableInterface;
use App\Filters\QueryFilters\CreateAtQueryFilter;
use App\Filters\QueryFilters\PublishedQueryFilter;
use App\Filters\QueryFilters\TitleQueryFilter;
use App\Models\User;

class PostFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    protected $filters = [
        'published' => PublishedQueryFilter::class,
        // 'title' => TitleQueryFilter::class
        'date' => CreateAtQueryFilter::class
    ];

}

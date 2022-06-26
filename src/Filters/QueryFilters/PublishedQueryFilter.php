<?php

namespace App\Filters\QueryFilters;

use App\Filters\Abstracts\QueryFilterAbstract;
use App\Filters\Interfaces\QueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class PublishedQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    protected $mapValues = [
        'true' => true,
        'false' => false
    ];

    public function handle(Builder $builder, $value)
    {
        $value = $this->resolveValue($value);

        if (is_null($value)) {
            return $builder;
        }

        return $builder->where('published', $value);
    }
}

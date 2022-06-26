<?php

namespace TheJano\LaravelFilterable\Tests\Filters\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class PublishedQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    protected array $mapValues = [
        'true' => true,
        'false' => false,
    ];

    public function handle(Builder $builder, $value): Builder
    {
        $value = $this->resolveValue($value);

        if (is_null($value)) {
            return $builder;
        }

        return $builder->where('published', $value);
    }
}

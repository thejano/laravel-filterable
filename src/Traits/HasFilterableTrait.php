<?php

namespace TheJano\LaravelFilterable\Traits;

use Illuminate\Contracts\Database\Query\Builder;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;
use TheJano\LaravelFilterable\Tests\Filterable\DefaultFilterable;

trait HasFilterableTrait
{
    use QueryFiltersTrait;

    public function scopeFilterable(Builder $builder, $request = null, $filterableClass = null, $filters = []): Builder
    {
        if (is_array($filterableClass)) {
            $filters = $filterableClass;
        }


        if (! is_null($request) && ((new $request()) instanceof FilterableInterface)) {
            $filterableClass = $request;
            $request = request();
        }

        if ($filterableClass == null && $this->modelFilterableClass() != null) {
            $filterableClass = $this->modelFilterableClass();
        }


        return (new $filterableClass($request))->add($filters)->filter($builder);
    }


    public function filterableClass()
    {
        return DefaultFilterable::class;
    }

    protected function modelFilterableClass()
    {
        return $this->filterableClass();
    }
}

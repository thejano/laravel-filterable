<?php

namespace TheJano\LaravelFilterable\Traits;

use Illuminate\Contracts\Database\Query\Builder;
use TheJano\LaravelFilterable\Filterable\DefaultFilterable;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;

trait HasFilterableTrait
{
    use QueryFiltersTrait;

    public function scopeFilterable(Builder $builder, $request = null, $filterableClass = null, $filters = []): Builder
    {
        if (\is_array($filterableClass)) {
            $filters = $filterableClass;
        }

        if (null !== $request && ! \is_array($request) && ((new $request()) instanceof FilterableInterface)) {
            $filterableClass = $request;
            $request = request();
        }

        if (null === $filterableClass && null !== $this->modelFilterableClass()) {
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

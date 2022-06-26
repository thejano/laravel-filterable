<?php

namespace TheJano\LaravelFilterable\Traits;

use Illuminate\Contracts\Database\Query\Builder;

trait HasFilterableTrait
{
    use QueryFiltersTrait;

    public function scopeFilterable(Builder $builder, $model = null, $filters = [])
    {
        if ($model == null && $this->filterableClass() != null) {
            $model = $this->filterableClass();
        }

        return (new $model())->add($filters)->filter($builder);
    }

    public function filterableClass()
    {
        return null;
    }
}

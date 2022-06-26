<?php

namespace TheJano\LaravelFilterable\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class CreatedAtQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    public function handle(Builder $builder, $value): Builder
    {
        if (is_null($value)) {
            return $builder;
        }

        return $builder->betweenDate([$value['from'],$value['to']], 'created_at');
    }
}

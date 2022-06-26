<?php

namespace TheJano\LaravelFilterable\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class OrderQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    protected array $mapValues = [
      'asc' => 'ASC',
      'ASC' => 'ASC',
      'desc' => 'DESC',
      'DESC' => 'DESC',
    ];

    public function handle(Builder $builder, $value): Builder
    {
        if (is_null($value)) {
            return $builder;
        }

        if (is_array($value)) {
            $field = array_key_first($value);
            $order = $value[$field];
        } else {
            $field = 'created_at';
            $order = $value;
        }

        $order = $this->resolveValue($order);

        return $builder->janoOrderModel($field, $order);
    }
}

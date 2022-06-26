<?php

namespace TheJano\LaravelFilterable\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class DateQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    public function handle(Builder $builder, $value): Builder
    {
        if (is_null($value)) {
            return $builder;
        }

        $date = $value;
        $field = 'created_at';

        $key = array_key_first($value);
        $delimiter = 'BY';

        if (str($key)->contains([$delimiter])) {
            $field = str($key)->explode($delimiter)->last();
            $date = collect($date)->mapWithKeys(function ($item, $key) use ($delimiter) {
                $key = str($key)->explode($delimiter)->first();

                return [
                  $key => $item,
                ];
            })->all();
        }


        return $builder->betweenDate([$date['from'],$date['to']], $field);
    }
}

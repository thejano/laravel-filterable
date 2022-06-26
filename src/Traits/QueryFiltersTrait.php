<?php

namespace TheJano\LaravelFilterable\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait QueryFiltersTrait
{
    public static function scopeJanoLike(Builder $builder, $field, $value): Builder
    {
        return $builder->where($field, 'LIKE', '%' . $value . "%");
    }

    public static function scopeJanoOrLike(Builder $builder, $field, $value): Builder
    {
        return $builder->orWhere($field, 'LIKE', '%' . $value . "%");
    }

    public static function scopeJanoOrderModel(Builder $builder, $field = 'created_at', $order = 'DESC'): Builder
    {
        return  $builder->orderBy($field, $order);
    }

    public static function scopeJanoBetweenDate(Builder $builder, $dates, $field = 'created_at'): Builder
    {
        return $builder->whereBetween($field, [
            Carbon::parse($dates[0])->startOfDay(),
            Carbon::parse($dates[1])->endOfDay(),
        ]);
    }
}

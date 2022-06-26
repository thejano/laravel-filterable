<?php

namespace TheJano\LaravelFilterable\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait QueryFiltersTrait
{
    public static function scopeLike(Builder $builder, $feild, $value): Builder
    {
        return $builder->where($feild, 'LIKE', '%' . $value . "%");
    }

    public static function scopeOrLike(Builder $builder, $feild, $value): Builder
    {
        return $builder->orWhere($feild, 'LIKE', '%' . $value . "%");
    }

    public static function scopeOrderModel(Builder $builder, $field = 'created_at', $order = 'DESC'): Builder
    {
        return  $builder->orderBy($field, $order);
    }

    public static function scopeBetweenDate(Builder $builder, $dates, $feild = 'created_at'): Builder
    {
        return $builder->whereBetween($feild, [
            Carbon::parse($dates[0])->startOfDay(),
            Carbon::parse($dates[1])->endOfDay(),
        ]);
    }
}

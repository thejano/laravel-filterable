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
        $firstDate = Carbon::parse($dates[0]);
        $secondDate = Carbon::parse($dates[1]);

        $isFirstDateValid = $firstDate->format('Y-m-d') == $dates[0];
        $isSecondDateValid = $secondDate->format('Y-m-d') == $dates[1];

        if (! $isFirstDateValid || ! $isSecondDateValid) {
            return $builder;
        }

        return $builder->whereBetween($field, [
            $firstDate->startOfDay(),
            $secondDate->endOfDay(),
        ]);
    }
}

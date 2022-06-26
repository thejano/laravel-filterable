<?php

namespace TheJano\LaravelFilterable\QueryFilter;

class DefaultFilters
{
    public static function list(): array
    {
        return [
            'created_at' => CreatedAtQueryFilter::class,
        ];
    }
}

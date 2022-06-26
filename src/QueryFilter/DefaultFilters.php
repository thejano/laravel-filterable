<?php

namespace TheJano\LaravelFilterable\QueryFilter;

class DefaultFilters
{
    public static function list(): array
    {
        return config('filterable.deafult_query_filters');
    }
}

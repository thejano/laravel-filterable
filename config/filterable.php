<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Assign Namespace for Filterable & Query Filter Classes
    |--------------------------------------------------------------------------
    |
    |
    */

    'filterable_namespace' => "App\\Filters\\Filterable",
    'query_filter_namespace' => "App\\Filters\\QueryFilter",

    /*
    |--------------------------------------------------------------------------
    | Assign Class suffix for Filterable & Query Filter Classes
    |--------------------------------------------------------------------------
    |
    |
    */

    'filterable_suffix' => 'Filterable',
    'query_filter_suffix' => 'QueryFilter',

    /*
    |--------------------------------------------------------------------------
    | Default Query Filters
    |--------------------------------------------------------------------------
    | They are available with every Filterable class
    |
    */

    'deafult_query_filters' => [
        'date' => \TheJano\LaravelFilterable\QueryFilter\DateQueryFilter::class,
        'order' => \TheJano\LaravelFilterable\QueryFilter\OrderQueryFilter::class,
    ],


];

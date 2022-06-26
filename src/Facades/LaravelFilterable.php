<?php

namespace TheJano\LaravelFilterable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TheJano\LaravelFilterable\LaravelFilterable
 */
class LaravelFilterable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-filterable';
    }
}

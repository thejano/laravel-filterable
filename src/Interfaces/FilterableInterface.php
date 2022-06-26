<?php

namespace TheJano\LaravelFilterable\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface FilterableInterface
{
    public function filter(Builder $builder): Builder;
}

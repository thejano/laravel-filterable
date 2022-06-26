<?php

namespace TheJano\LaravelFilterable\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilterInterface
{
    public function handle(Builder $builder, $value): Builder;
}

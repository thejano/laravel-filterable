<?php

namespace App\Filters\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilterInterface
{
    public function handle(Builder $builder, $value);
}

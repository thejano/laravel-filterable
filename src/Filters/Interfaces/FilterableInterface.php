<?php

namespace App\Filters\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface FilterableInterface
{
    public function filter(Builder $builder);
}

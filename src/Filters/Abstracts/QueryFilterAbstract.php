<?php

namespace App\Filters\Abstracts;

abstract class QueryFilterAbstract
{
    protected $mapValues = [];

    protected function resolveValue($value)
    {
        return $this->mapValues[$value] ?? null;
    }
}

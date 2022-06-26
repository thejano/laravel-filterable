<?php

namespace TheJano\LaravelFilterable\Abstracts;

abstract class QueryFilterAbstract
{
    protected array $mapValues = [];

    protected function resolveValue($value)
    {
        return $this->mapValues[$value] ?? null;
    }
}

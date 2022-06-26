<?php

namespace TheJano\LaravelFilterable\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeQueryFilter extends GeneratorCommand
{
    protected $signature = 'make:query-filter {name}';
    protected $description = 'Generate A Query filter class';
    protected $type = 'Query Filter class';

    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/query-filter.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return config('filterable.query_filter_namespace');
    }
}

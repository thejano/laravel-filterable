<?php

namespace TheJano\LaravelFilterable\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeFilterable extends GeneratorCommand
{
    protected $signature = 'make:filterable {name} {--ns|namespace=}';

    protected $description = 'Create a new filterable class';

    protected $type = 'Filterable class';

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/filterable.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        if (null !== $this->option('namespace')) {
            return $this->option('namespace');
        }

        return config('filterable.filterable_namespace');
    }
}

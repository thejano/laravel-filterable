<?php

namespace TheJano\LaravelFilterable\Commands;

use Illuminate\Console\GeneratorCommand;
use TheJano\LaravelFilterable\Utils\CommandUtil;

class MakeQueryFilter extends GeneratorCommand
{
    protected $signature = 'make:query-filter {name} {--filterable=}';
    protected $description = 'Create a new Query filter class';
    protected $type = 'Query Filter class';

    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/query-filter.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return config('filterable.query_filter_namespace');
    }

    public function handle()
    {
        $queryFilter = $this->queryFilter();
        $filterable = $this->filterable();

        $isQueryFilterExists = file_exists($queryFilter->path);

        parent::handle();

        if (is_null($filterable->name)) {
            return false;
        }

        if (! file_exists($filterable->path)) {
            return false;
        }

        if ($isQueryFilterExists) {
            return false;
        }

        $newFilter = CommandUtil::getNewFilter($queryFilter);

        CommandUtil::appendNewFilterTo($filterable, $newFilter);

        $this->comment("{$queryFilter->name} added to {$filterable->name}");
    }

    public function queryFilter(): object
    {
        return (new CommandUtil())->initializeClass(
            $this->argument('name'),
            'query_filter',
        );
    }

    public function filterable(): object
    {
        return (new CommandUtil())->initializeClass(
            $this->option('filterable'),
            'filterable'
        );
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeQueryFilter extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:query-filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate A QUery filter class';

    /**
     * Generate Filterable class
     *
     * @var Array
     */
    protected $type = 'Query Filter class';

    protected function getStub()
    {
        return base_path('stubs/query-filter.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Filters\QueryFilters';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeFilterable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filterable {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate A filterable class';

    /**
     * Generate Filter
     *
     * @var Array
     */
    protected $type = 'Filterable class';

    protected function getStub()
    {
        return __DIR__.'.../../stubs/filterable.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return config('filterable.filterable_namespace');
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

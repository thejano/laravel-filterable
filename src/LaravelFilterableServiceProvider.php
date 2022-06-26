<?php

namespace TheJano\LaravelFilterable;

use App\Console\Commands\MakeFilterable;
use App\Console\Commands\MakeQueryFilter;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TheJano\LaravelFilterable\Commands\LaravelFilterableCommand;

class LaravelFilterableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-filterable')
            ->hasConfigFile()
            ->hasCommand(MakeQueryFilter::class)
            ->hasCommand(MakeFilterable::class);
    }
}

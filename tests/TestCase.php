<?php

namespace TheJano\LaravelFilterable\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

use TheJano\LaravelFilterable\LaravelFilterableServiceProvider;
use TheJano\LaravelFilterable\Tests\Migrations\CatgeoryMigration;
use TheJano\LaravelFilterable\Tests\Migrations\PostsMigration;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->migrate();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelFilterableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-filterable_table.php.stub';
        $migration->up();
        */
    }

    public function migrate()
    {
        $migrations = [
            PostsMigration::class,
            CatgeoryMigration::class,
        ];

        foreach ($migrations as $migration) {
            (new $migration())->up();
        }
    }
}

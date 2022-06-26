<?php

namespace TheJano\LaravelFilterable\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

use TheJano\LaravelFilterable\LaravelFilterableServiceProvider;
use TheJano\LaravelFilterable\Tests\Migrations\PostsMigration;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->migrate();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'TheJano\\LaravelFilterable\\database\\Factories\\'.class_basename($modelName).'Factory'
        );
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
        ];

        foreach ($migrations as $migration) {
            (new $migration())->up();
        }
    }
}

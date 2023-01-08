<?php

namespace Nanopkg\LaravelBulkSmsBd\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nanopkg\LaravelBulkSmsBd\LaravelBulkSmsBdServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Nanopkg\\LaravelBulkSmsBd\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBulkSmsBdServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-bulk-sms-bd_table.php.stub';
        $migration->up();
        */
    }
}

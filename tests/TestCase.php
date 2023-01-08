<?php

namespace Nanopkg\LaravelBulkSmsBd\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nanopkg\LaravelBulkSmsBd\BulkSmsBdServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BulkSmsBdServiceProvider::class,
        ];
    }
}

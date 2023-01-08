<?php

namespace Nanopkg\LaravelBulkSmsBd\Tests;

use Nanopkg\LaravelBulkSmsBd\BulkSmsBdServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BulkSmsBdServiceProvider::class,
        ];
    }
}

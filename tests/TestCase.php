<?php

namespace Nanopkg\BulkSmsBd\Tests;

use Nanopkg\BulkSmsBd\BulkSmsBdServiceProvider;
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

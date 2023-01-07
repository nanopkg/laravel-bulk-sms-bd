<?php

namespace Nanopkg\LaravelBulkSmsBd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nanopkg\LaravelBulkSmsBd\LaravelBulkSmsBd
 */
class LaravelBulkSmsBd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nanopkg\LaravelBulkSmsBd\LaravelBulkSmsBd::class;
    }
}

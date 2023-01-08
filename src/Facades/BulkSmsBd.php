<?php

namespace Nanopkg\LaravelBulkSmsBd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * class BulkSmsBd
 *
 * @method static \Nanopkg\LaravelBulkSmsBd\BulkSmsBd OneToOne(string $to, string $message)
 * @method static \Nanopkg\LaravelBulkSmsBd\BulkSmsBd ManyToMany(array $to, string $message)
 * @method static \Nanopkg\LaravelBulkSmsBd\BulkSmsBd send()
 * @method static \Nanopkg\LaravelBulkSmsBd\BulkSmsBd getBalance()
 *
 * @see \Nanopkg\LaravelBulkSmsBd\BulkSmsBd
 */
class BulkSmsBd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nanopkg\LaravelBulkSmsBd\BulkSmsBd::class;
    }
}

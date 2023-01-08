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
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
class BulkSmsBd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Nanopkg\LaravelBulkSmsBd\BulkSmsBd::class;
    }
}

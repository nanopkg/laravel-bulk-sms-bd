<?php

namespace Nanopkg\BulkSmsBd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * class BulkSmsBd
 *
 * @method static \Nanopkg\BulkSmsBd\BulkSmsBd OneToOne(string $to, string $message, string $type = 'text')
 * @method static \Nanopkg\BulkSmsBd\BulkSmsBd OneToMany(array $contacts, string $msg, string $type = 'text')
 * @method static \Nanopkg\BulkSmsBd\BulkSmsBd ManyToMany(array $contacts)
 * @method static \Nanopkg\BulkSmsBd\BulkSmsBd send()
 * @method static \Nanopkg\BulkSmsBd\BulkSmsBd getBalance()
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
        return \Nanopkg\BulkSmsBd\BulkSmsBd::class;
    }
}

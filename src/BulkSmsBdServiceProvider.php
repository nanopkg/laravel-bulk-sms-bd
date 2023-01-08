<?php

namespace Nanopkg\LaravelBulkSmsBd;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class LaravelBulkSmsBdServiceProvider
 *
 * @package Nanopkg\LaravelBulkSmsBd
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 * @link https://iqbalhasan.dev Author Homepage
 * @license LICENSE The MIT License
 */
class BulkSmsBdServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-bulk-sms-bd')
            ->hasConfigFile(['bulksmsbd']);
    }
}

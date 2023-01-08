<?php

namespace Nanopkg\LaravelBulkSmsBd;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Nanopkg\LaravelBulkSmsBd\Commands\LaravelBulkSmsBdCommand;

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
            ->hasConfigFile();
    }
}

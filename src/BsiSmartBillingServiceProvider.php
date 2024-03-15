<?php

namespace Hasanbasri1993\BsiSmartBilling;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Hasanbasri1993\BsiSmartBilling\Commands\BsiSmartBillingCommand;

class BsiSmartBillingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('bsi-smart-billing')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_bsi-smart-billing_table')
            ->hasCommand(BsiSmartBillingCommand::class);
    }
}

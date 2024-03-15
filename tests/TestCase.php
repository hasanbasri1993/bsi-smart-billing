<?php

namespace Hasanbasri1993\BsiSmartBilling\Tests;

use Hasanbasri1993\BsiSmartBilling\BsiSmartBillingServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Hasanbasri1993\\BsiSmartBilling\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            BsiSmartBillingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_bsi-smart-billing_table.php.stub';
        $migration->up();
        */
    }
}

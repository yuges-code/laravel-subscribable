<?php

namespace Yuges\Package\Tests;

use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\Attributes\WithMigration; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Yuges\Subscribable\Providers\SubscribableServiceProvider;

#[WithMigration] 
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        # code...

        parent::setUp();
    }

    protected function defineEnvironment($app) 
    {
        tap($app['config'], function (Repository $config) {
            $config->set('subscribable', require __DIR__ . '/../../config/subscribable.php');
        });
    }

    protected function getPackageProviders($app) 
    {
        return [
            SubscribableServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations() 
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../../database/migrations/'
        );
    }
}

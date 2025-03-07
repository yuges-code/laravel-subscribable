<?php

namespace Yuges\Package\Tests;

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

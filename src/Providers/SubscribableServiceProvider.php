<?php

namespace Yuges\Subscribable\Providers;

use TypeError;
use Yuges\Subscribable\Config\Config;
use Illuminate\Support\ServiceProvider;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Subscribable\Observers\SubscriptionObserver;

class SubscribableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $class = Config::getSubscriptionClass(Subscription::class);

        if (! is_a(new $class, Subscription::class)) {
            throw new TypeError('Invalid model');
        }

        $class::observe(new SubscriptionObserver);

        $this->publishes([
            __DIR__.'/../../config/subscribable.php' => config_path('subscribable.php')
        ], 'subscribable-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'subscribable-migrations');

        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders')
        ], 'subscribable-seeders');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/subscribable.php', 'subscribable'
        );
    }
}

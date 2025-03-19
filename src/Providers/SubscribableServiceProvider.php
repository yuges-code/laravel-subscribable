<?php

namespace Yuges\Subscribable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Subscribable\Config\Config;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Package\Providers\PackageServiceProvider;
use Yuges\Subscribable\Observers\SubscriptionObserver;
use Yuges\Subscribable\Exceptions\InvalidSubscription;

class SubscribableServiceProvider extends PackageServiceProvider
{
    public function configure(Package $package): void
    {
        $subscription = Config::getSubscriptionClass(Subscription::class);

        if (! is_a($subscription, Subscription::class, true)) {
            throw InvalidSubscription::doesNotImplementSubscription($subscription);
        }

        $package
            ->hasConfig('subscribable')
            ->hasObserver($subscription, SubscriptionObserver::class);
    }

    public function packageBooted(): void
    {
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
}

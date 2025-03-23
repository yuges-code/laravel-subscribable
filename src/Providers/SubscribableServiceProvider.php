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
    protected string $name = 'laravel-subscribable';

    public function configure(Package $package): void
    {
        $subscription = Config::getSubscriptionClass(Subscription::class);

        if (! is_a($subscription, Subscription::class, true)) {
            throw InvalidSubscription::doesNotImplementSubscription($subscription);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('subscribable')
            ->hasMigrations([
                'create_plans_table',
                'create_features_table',
                'create_subscriptions_table',
            ])
            ->hasObserver($subscription, SubscriptionObserver::class);
    }
}

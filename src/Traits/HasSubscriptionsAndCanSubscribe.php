<?php

namespace Yuges\Subscribable\Traits;

trait HasSubscriptionsAndCanSubscribe
{
    use HasSubscriptions, CanSubscribe {
        HasSubscriptions::subscriptions insteadof CanSubscribe;
        HasSubscriptions::latestSubscription insteadof CanSubscribe;
        HasSubscriptions::oldestSubscription insteadof CanSubscribe;
    }
}

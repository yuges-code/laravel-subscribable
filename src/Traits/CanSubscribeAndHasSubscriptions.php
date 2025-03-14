<?php

namespace Yuges\Subscribable\Traits;

trait CanSubscribeAndHasSubscriptions
{
    use CanSubscribe, HasSubscriptions {
        CanSubscribe::subscriptions insteadof HasSubscriptions;
        CanSubscribe::latestSubscription insteadof HasSubscriptions;
        CanSubscribe::oldestSubscription insteadof HasSubscriptions;
    }
}

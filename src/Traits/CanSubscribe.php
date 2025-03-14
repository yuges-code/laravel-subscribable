<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Config\Config;
use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<array-key, Subscription> $subscriptions
 * @property Collection<array-key, Subscription> $subscriberSubscriptions
 * @property ?Subscription $latestSubscription
 * @property ?Subscription $latestSubscriberSubscriptions
 * @property ?Subscription $oldestSubscription
 * @property ?Subscription $oldestSubscriberSubscriptions
 */
trait CanSubscribe
{
    public function subscriptions(): MorphMany
    {
        return $this->subscriberSubscriptions();
    }

    public function subscriberSubscriptions(): MorphMany
    {
        return $this->morphMany(Config::getSubscriptionClass(Subscription::class), 'subscriber');
    }

    public function latestSubscription(): MorphOne
    {
        return $this->latestSubscriberSubscriptions();
    }

    public function latestSubscriberSubscriptions(): MorphOne
    {
        return $this->subscriberSubscriptions()->one()->latestOfMany();
    }

    public function oldestSubscription(): MorphOne
    {
        return $this->oldestSubscriberSubscriptions();
    }

    public function oldestSubscriberSubscriptions(): MorphOne
    {
        return $this->subscriberSubscriptions()->one()->oldestOfMany();
    }
}

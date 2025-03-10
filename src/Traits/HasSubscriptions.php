<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Yuges\Subscribable\Config\Config;
use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Yuges\Subscribable\Interfaces\Subscriber;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<array-key, Subscription> $subscription
 * @property ?Subscription $latestSubscription
 * @property ?Subscription $oldestSubscription
 */
trait HasSubscriptions
{
    public function subscriptions(): MorphMany
    {
        return $this->morphMany(Config::getSubscriptionClass(), 'subscribable');
    }

    public function latestSubscription(): MorphOne
    {
        return $this->subscriptions()->one()->latestOfMany();
    }

    public function oldestSubscription(): MorphOne
    {
        return $this->subscriptions()->one()->oldestOfMany();
    }

    public function subscribe(?Subscriber $subscriber = null, ?Plan $plan = null): Subscription
    {
        return Config::getCreateSubscriptionAction($this)->execute($subscriber, $plan);
    }

    public function unsubscribe(?Subscriber $subscriber = null, ?Plan $plan = null): Subscription
    {
        return Config::getDeleteSubscriptionAction($this)->execute($subscriber, $plan);
    }

    public function toggleSubscribe(?Subscriber $subscriber = null, ?Plan $plan = null): ?Subscription
    {
        return Config::getToggleSubscriptionAction($this)->execute($subscriber, $plan);
    }

    public function defaultSubscriber(): ?Subscriber
    {
        /** @var ?Subscriber */
        $subscriber = Auth::user();

        return $subscriber;
    }
}

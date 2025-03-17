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
 * @property Collection<array-key, Subscription> $subscriptions
 * @property Collection<array-key, Subscription> $subscribableSubscriptions
 * @property ?Subscription $latestSubscription
 * @property ?Subscription $latestSubscribableSubscription
 * @property ?Subscription $oldestSubscription
 * @property ?Subscription $oldestSubscribableSubscription
 */
trait HasSubscriptions
{
    public function subscriptions(): MorphMany
    {
        return $this->subscribableSubscriptions();
    }

    public function subscribableSubscriptions(): MorphMany
    {
        return $this->morphMany(Config::getSubscriptionClass(Subscription::class), 'subscribable');
    }

    public function latestSubscription(): MorphOne
    {
        return $this->latestSubscribableSubscription();
    }

    public function latestSubscribableSubscription(): MorphOne
    {
        return $this->subscribableSubscriptions()->one()->latestOfMany();
    }

    public function oldestSubscription(): MorphOne
    {
        return $this->oldestSubscribableSubscription();
    }

    public function oldestSubscribableSubscription(): MorphOne
    {
        return $this->subscribableSubscriptions()->one()->oldestOfMany();
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

<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Yuges\Subscribable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Yuges\Subscribable\Interfaces\Subscriber;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property ?Subscription $subscription
 * @property ?Subscription $latestSubscription
 * @property ?Subscription $latestSubscribableSubscription
 * @property ?Subscription $oldestSubscription
 * @property ?Subscription $oldestSubscribableSubscription
 * @property Collection<array-key, Subscription> $subscriptions
 * @property Collection<array-key, Subscription> $subscribableSubscriptions
 */
trait HasSubscriptions
{
    public function subscription(): MorphOne
    {
        $subscriber = $this->defaultSubscriber();

        return $this->subscribableSubscriptions()->one()->ofMany([
            'id' => 'max',
        ], function (Builder $query) use ($subscriber) {
            $query->whereMorphedTo('subscriber', $subscriber);
        });
    }

    public function subscriptions(): MorphMany
    {
        return $this->subscribableSubscriptions();
    }

    public function subscribableSubscriptions(): MorphMany
    {
        /** @var Model $this */
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

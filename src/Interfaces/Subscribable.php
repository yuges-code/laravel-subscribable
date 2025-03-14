<?php

namespace Yuges\Subscribable\Interfaces;

use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Subscribable
{
    public function subscriptions(): MorphMany;

    public function subscribableSubscriptions(): MorphMany;

    public function latestSubscription(): MorphOne;

    public function latestSubscribableSubscription(): MorphOne;

    public function oldestSubscription(): MorphOne;

    public function oldestSubscribableSubscription(): MorphOne;

    public function subscribe(?Subscriber $subscriber = null, ?Plan $plan = null): Subscription;

    public function unsubscribe(?Subscriber $subscriber = null, ?Plan $plan = null): Subscription;

    public function toggleSubscribe(?Subscriber $subscriber = null, ?Plan $plan = null): ?Subscription;

    public function defaultSubscriber(): ?Subscriber;
}

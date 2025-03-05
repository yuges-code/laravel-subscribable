<?php

namespace Yuges\Subscribable\Interfaces;

use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Subscribable
{
    public function subscriptions(): MorphMany;

    public function subscribe(string $plan, ?Subscriber $subscriber = null): Subscription;

    public function defaultSubscriber(): ?Subscriber;
}

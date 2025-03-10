<?php

namespace Yuges\Subscribable\Actions;

use Exception;
use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Yuges\Subscribable\Exceptions\InvalidSubscriber;

class CreateSubscriptionAction
{
    public function __construct(
        protected Subscribable $subscribable
    ) {
    }

    public static function create(Subscribable $subscribable): self
    {
        return new static($subscribable);
    }

    public function execute(?Subscriber $subscriber = null, ?Plan $plan = null): Subscription
    {
        $subscriber ??= $this->getDefaultSubscriber();

        $this->validateSubscriber($subscriber);

        if (! $subscriber instanceof Model) {
            throw new Exception('Subscriber is not eloquent model');
        }

        $attributes = [
            'plan_id' => $plan?->getKey() ?? null,
            'subscriber_id' => $subscriber?->getKey() ?? null,
            'subscriber_type' => $subscriber?->getMorphClass() ?? null,
        ];

        $subscription = $this->subscribable
            ->subscriptions()
            ->getQuery()
            ->whereMorphedTo('subscriber', $subscriber)
            ->first();

        return $subscription ?? $this->subscribable->subscriptions()->create($attributes);
    }

    public function validateSubscriber(?Subscriber $subscriber = null): void
    {
        if (! $subscriber) {
            return;
        }

        $class = get_class($subscriber);
        $allowed = Config::getSubscriberAllowedClasses()->push(Config::getSubscriberDefaultClass());

        if (! $allowed->contains($class)) {
            throw InvalidSubscriber::doesNotContainInAllowedConfig($class);
        }
    }

    public function getDefaultSubscriber(): ?Subscriber
    {
        $subscriber = $this->subscribable->defaultSubscriber();

        if (! $subscriber) {
            return null;
        }

        $class = get_class($subscriber);

        if (Config::getSubscriberDefaultClass() !== $class) {
            throw InvalidSubscriber::doesNotContainInDefaultConfig($class);
        }

        return $subscriber;
    }
}

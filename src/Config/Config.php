<?php

namespace Yuges\Subscribable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Models\Feature;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Yuges\Subscribable\Actions\CreateSubscriptionAction;
use Yuges\Subscribable\Actions\DeleteSubscriptionAction;
use Yuges\Subscribable\Actions\ToggleSubscriptionAction;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'subscribable';

    /** @return class-string<Plan> */
    public static function getPlanClass(mixed $default = null): string
    {
        return self::get('models.plan.class', $default);
    }

    public static function getPlanKeyType(mixed $default = null): KeyType
    {
        return self::get('models.plan.key', $default);
    }

    /** @return class-string<Feature> */
    public static function getFeatureClass(mixed $default = null): string
    {
        return self::get('models.feature.class', $default);
    }

    public static function getFeatureKeyType(mixed $default = null): KeyType
    {
        return self::get('models.feature.key', $default);
    }

    /** @return class-string<Subscription> */
    public static function getSubscriptionClass(mixed $default = null): string
    {
        return self::get('models.subscription.class', $default);
    }

    public static function getSubscriptionKeyType(mixed $default = null): KeyType
    {
        return self::get('models.subscription.key', $default);
    }

    /** @return class-string<Subscriber> */
    public static function getSubscriberDefaultClass(mixed $default = null): string
    {
        return self::get('models.subscriber.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Subscriber>> */
    public static function getSubscriberAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.subscriber.allowed', $default)
        );
    }

    public static function getSubscriberKeyType(mixed $default = null): KeyType
    {
        return self::get('models.subscriber.key', $default);
    }

    /** @return class-string<Subscribable> */
    public static function getSubscribableDefaultClass(mixed $default = null): string
    {
        return self::get('models.subscribable.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Subscribable>> */
    public static function getSubscribableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.subscribable.allowed', $default)
        );
    }

    public static function getSubscribableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.subscribable.key', $default);
    }

    public static function getCreateSubscriptionAction(
        Subscribable $subscribable,
        mixed $default = null
    ): CreateSubscriptionAction
    {
        return self::getCreateSubscriptionActionClass($default)::create($subscribable);
    }

    /** @return class-string<CreateSubscriptionAction> */
    public static function getCreateSubscriptionActionClass(mixed $default = null): string
    {
        return self::get('actions.create', $default);
    }

    public static function getDeleteSubscriptionAction(
        Subscribable $subscribable,
        mixed $default = null
    ): DeleteSubscriptionAction
    {
        return self::getDeleteSubscriptionActionClass($default)::create($subscribable);
    }

    /** @return class-string<DeleteSubscriptionAction> */
    public static function getDeleteSubscriptionActionClass(mixed $default = null): string
    {
        return self::get('actions.delete', $default);
    }

    public static function getToggleSubscriptionAction(
        Subscribable $subscribable,
        mixed $default = null
    ): ToggleSubscriptionAction
    {
        return self::getToggleSubscriptionActionClass($default)::create($subscribable);
    }

    /** @return class-string<ToggleSubscriptionAction> */
    public static function getToggleSubscriptionActionClass(mixed $default = null): string
    {
        return self::get('actions.toggle', $default);
    }
}

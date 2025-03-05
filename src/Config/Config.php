<?php

namespace Yuges\Subscribable\Config;

use Yuges\Subscribable\Models\Subscription;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'subscribable';

        /** @return class-string<Subscription> */
    public static function getPlanClass(mixed $default = null): string
    {
        return self::get('models.plan.class', $default);
    }

    /** @return class-string<Subscription> */
    public static function getSubscriptionClass(mixed $default = null): string
    {
        return self::get('models.subscription.class', $default);
    }

}

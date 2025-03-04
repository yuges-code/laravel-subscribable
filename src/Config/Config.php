<?php

namespace Vendor\Template\Config;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'subscribable';

    /** @return class-string<Reaction> */
    public static function getSubscriptionClass(mixed $default = null): string
    {
        return self::get('models.subscription.class', $default);
    }

    
}

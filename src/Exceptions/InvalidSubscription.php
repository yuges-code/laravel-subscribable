<?php

namespace Yuges\Subscribable\Exceptions;

use Exception;
use TypeError;
use Yuges\Subscribable\Models\Subscription;

class InvalidSubscription extends Exception
{
    public static function doesNotImplementSubscription(string $class): TypeError
    {
        $subscription = Subscription::class;

        return new TypeError("Subscription class `{$class}` must implement `{$subscription}`");
    }
}

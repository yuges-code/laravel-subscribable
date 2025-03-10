<?php

namespace Yuges\Subscribable\Exceptions;

use Exception;

class InvalidSubscriber extends Exception
{
    public static function doesNotContainInAllowedConfig(string $class): self
    {
        return new static("Subscriber class `{$class}` doesn't contain in allowed subscribers config");
    }

    public static function doesNotContainInDefaultConfig(string $class): self
    {
        return new static("Subscriber class `{$class}` doesn't contain in default subscriber config");
    }
}

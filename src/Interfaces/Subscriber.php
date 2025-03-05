<?php

namespace Yuges\Subscribable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Subscriber
{
    public function subscriptions(): MorphMany;
}

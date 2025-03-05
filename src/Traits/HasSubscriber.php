<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Interfaces\Subscriber;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $subscriber_type
 * @property int|string $subscriber_id
 * 
 * @property Subscriber $subscriber
 */
trait HasSubscriber
{
    public function subscriber(): MorphTo
    {
        return $this->morphTo();
    }
}

<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Interfaces\Subscribable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $subscribable_type
 * @property int|string $subscribable_id
 * 
 * @property Subscribable $subscribable
 */
trait HasSubscribable
{
    public function subscribable(): MorphTo
    {
        return $this->morphTo();
    }
}

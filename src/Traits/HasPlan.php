<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property null|int|string $plan_id
 * 
 * @property Plan $plan
 */
trait HasPlan
{
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Config::getPlanClass(Plan::class));
    }
}

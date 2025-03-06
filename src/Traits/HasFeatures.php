<?php

namespace Yuges\Subscribable\Traits;

use Yuges\Subscribable\Config\Config;
use Yuges\Subscribable\Models\Feature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection<array-key, Feature> $features
 */
trait HasFeatures
{
    public function features(): HasMany
    {
        return $this->hasMany(Config::getFeatureClass(Feature::class));
    }
}

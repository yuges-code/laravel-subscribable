<?php

namespace Yuges\Subscribable\Observers;

use Illuminate\Database\Eloquent\Model;

class SubscriptionObserver
{
    public function saving(Model $model): void
    {

    }

    public function deleted(Model $model): void
    {

    }
}

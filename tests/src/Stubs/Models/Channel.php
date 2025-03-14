<?php

namespace Yuges\Subscribable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Yuges\Subscribable\Traits\HasSubscriptionsAndCanSubscribe;

class Channel extends Model implements Subscriber, Subscribable
{
    use HasUlids, HasSubscriptionsAndCanSubscribe;

    protected $table = 'channels';

    protected $guarded = ['id'];
}

<?php

namespace Yuges\Subscribable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Yuges\Subscribable\Traits\HasSubscriptionsAndCanSubscribe;

class Channel extends Model implements Subscriber, Subscribable
{
    use HasSubscriptionsAndCanSubscribe;

    protected $table = 'channels';

    protected $guarded = ['id'];
}

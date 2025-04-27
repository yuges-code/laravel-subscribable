<?php

namespace Yuges\Subscribable\Tests\Stubs\Models;

use Yuges\Package\Traits\HasTable;
use Yuges\Subscribable\Interfaces\Subscriber;
use Yuges\Subscribable\Interfaces\Subscribable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yuges\Subscribable\Traits\HasSubscriptionsAndCanSubscribe;

class User extends Authenticatable implements Subscriber, Subscribable
{
    use HasSubscriptionsAndCanSubscribe, HasTable;

    protected $table = 'users';

    protected $guarded = ['id'];
}

<?php

namespace Yuges\Subscribable\Models;

use Yuges\Package\Models\Model;
use Yuges\Subscribable\Traits\HasSubscriber;
use Yuges\Subscribable\Traits\HasSubscribable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use
        HasUlids,
        HasFactory,
        HasSubscriber,
        HasSubscribable;

    protected $table = 'subscriptions';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
            'expired_at' => 'datetime',
        ];
    }
}

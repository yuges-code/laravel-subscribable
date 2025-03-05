<?php

namespace Yuges\Subscribable\Models;

use Carbon\Carbon;
use Yuges\Package\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Yuges\Subscribable\Traits\HasSubscriber;
use Yuges\Subscribable\Traits\HasSubscribable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * 
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
class Subscription extends Model
{
    use
        HasUlids,
        HasTable,
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

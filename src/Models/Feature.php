<?php

namespace Yuges\Subscribable\Models;

use Carbon\Carbon;
use Yuges\Subscribable\Traits\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int|string $id
 * 
 * @property-read ?Carbon $created_at
 * @property-read ?Carbon $updated_at
 */
class Feature extends Model
{
    use
        HasUlids,
        HasTable,
        HasFactory;

    protected $table = 'features';

    protected $guarded = ['id'];
}

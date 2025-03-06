<?php

namespace Yuges\Subscribable\Models;

use Yuges\Package\Models\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use
        HasUlids,
        HasFactory;

    protected $table = 'plans';

    protected $guarded = ['id'];
}

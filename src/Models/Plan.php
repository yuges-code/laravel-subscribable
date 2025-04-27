<?php

namespace Yuges\Subscribable\Models;

use Yuges\Package\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $guarded = ['id'];
}

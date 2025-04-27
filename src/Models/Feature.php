<?php

namespace Yuges\Subscribable\Models;

use Yuges\Package\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'features';

    protected $guarded = ['id'];
}

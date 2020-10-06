<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    protected $fillable = [
        'montly_goal', 'limbocoin_ars_price'
    ];
}

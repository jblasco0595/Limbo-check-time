<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraTime extends Model
{
    protected $fillable = [
        'hours', 'description', 'approved', 'user_id'
    ];
}

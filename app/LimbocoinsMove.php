<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimbocoinsMove extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'description', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

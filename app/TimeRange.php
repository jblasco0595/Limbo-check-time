<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRange extends Model
{
    protected $fillable = [
        'init_time', 'end_time', 'user_id', 'seconds_difference',
    ];

    protected $dates = [
        'init_time', 'end_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

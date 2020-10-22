<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    protected $fillable = [
        'project_id', 'date', 'amount'
    ];

    protected $dates = [
        'date'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}

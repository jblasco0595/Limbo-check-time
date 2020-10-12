<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    protected $fillable = [
        'project_id', 'date', 'amount'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}

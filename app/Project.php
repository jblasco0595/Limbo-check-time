<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description'
    ];
    public function project_payment()
    {
        return $this->hasMany('App\ProjectPayment');
    }
}

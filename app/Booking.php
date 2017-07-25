<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

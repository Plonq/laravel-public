<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

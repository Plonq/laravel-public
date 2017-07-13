<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function payment_detail()
    {
        return $this->belongsTo('App\PaymentDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

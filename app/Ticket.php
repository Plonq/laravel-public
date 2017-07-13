<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function ticket_type()
    {
        return $this->belongsTo('App\TicketType');
    }

    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
}

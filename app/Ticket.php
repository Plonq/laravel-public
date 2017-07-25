<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'quantity',
        'movie_session_id',
        'booking_id',
        'ticket_type_id'
    ];

    public function ticket_type()
    {
        return $this->belongsTo('App\TicketType');
    }

    public function movie_session()
    {
        return $this->belongsTo('App\MovieSession');
    }

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
}

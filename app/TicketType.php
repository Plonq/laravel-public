<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function cinema()
    {
        return $this->belongsTo('App\Cinema');
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}

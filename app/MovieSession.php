<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieSession extends Model
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

    // Calculated Attributes
    public function getScheduledDateStringAttribute()
    {
        return date('l, j F Y', strtotime($this->scheduled_at));
    }

    public function getScheduledTimeStringAttribute()
    {
        return date('g:s A', strtotime($this->scheduled_at));
    }
}

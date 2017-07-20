<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }

    public function movie_sessions()
    {
        return $this->hasMany('App\MovieSession');
    }

    public function wishlist_items()
    {
        return $this->hasMany('App\WishlistItem');
    }

    // Calculated Attributes
    public function getReleaseDateStringAttribute()
    {
        return date('l, j F Y', strtotime($this->release_date));
    }
}

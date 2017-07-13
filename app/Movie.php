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

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function wishlist_items()
    {
        return $this->hasMany('App\WishlistItem');
    }
}

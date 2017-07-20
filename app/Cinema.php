<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    public function movie_sessions()
    {
        return $this->hasMany('App\MovieSession');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'featured',
        'poster_path',
        'cover_path',
        'poster_path',
        'genre_id',
        'rating_id'
    ];

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

    /**
     * Returns array of movies coming soon
     *
     * Coming Soon includes movies with sessions more than three days in the future
     *
     * @return mixed
     */
    public static function coming_soon() {
        return Movie::whereHas('movie_sessions', function ($query) {
            $query->where('scheduled_at', '>', date('Y-m-d 00:00:00', strtotime('+4 days')));
        })
            ->whereNotIn('id', Movie::now_showing()->get(['id'])->toArray());
    }

    /**
     * Returns array of movies now showing
     *
     * Now Showing includes movies with at least one session in the next three days
     *
     * @return mixed
     */
    public static function now_showing()
    {
        return Movie::whereHas('movie_sessions', function ($query) {
            $query->where([
                ['scheduled_at', '>=', date('Y-m-d H:i:s')],
                ['scheduled_at', '<', date('Y-m-d 00:00:00', strtotime('+4 days'))]
            ]);
        });
    }
}

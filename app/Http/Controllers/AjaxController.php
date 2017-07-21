<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Cinema;
use App\MovieSession;

class AjaxController extends Controller
{

    /**
     * Searches movies
     *
     * @param $request
     * @return string
     */
    public function search(Request $request)
    {
//        var_dump($request->all());
        $search_term = $request->all()['search-term'];

        // Search for sessions based on search term
        // Searches: movie title, genre, rating; cinema address, city, postcode

        // Search movie title and genre
        $movies = Movie::whereHas('genre', function($query) use($search_term) {
                $query->where('name', 'LIKE', '%'.$search_term.'%');
        })
            ->orWhere('title', 'LIKE', '%'.$search_term.'%')
            ->join('genres', 'movies.genre_id', '=', 'genres.id')
            ->join('ratings', 'movies.rating_id', '=', 'ratings.id')
            ->select('movies.*', 'genres.name AS genre', 'ratings.name AS rating', 'ratings.code AS rating_code')
            ->get();

        // Search cinemas
        $cinemas = Cinema::where('address', 'LIKE', '%'.$search_term.'%')
                ->orWhere('city', 'LIKE', '%'.$search_term.'%')
                ->orWhere('postcode', 'LIKE', '%'.$search_term.'%')
                ->get();

        // Return both, we don't mind if one is empty
        return json_encode(array('movies' => $movies, 'cinemas' => $cinemas));
    }

    /**
     * Gets sessions for a movie cinema pair
     *
     * @param Request $request
     * @return string
     */
    public function get_sessions(Request $request)
    {
        // We expect a cinema ID and a movie ID
        $sessions = MovieSession::where([
            ['movie_id', $request->get('movie_id')],
            ['cinema_id', $request->get('cinema_id')]
        ])->get();

        foreach ($sessions as $session) {
            $session->date = date('l, j F Y', strtotime($session->scheduled_at));
            $session->time = date('g:i A', strtotime($session->scheduled_at));
        }

        return json_encode($sessions);
    }
}

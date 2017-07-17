<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Cinema;

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

        return json_encode(array('movies' => $movies, 'cinemas' => $cinemas));
    }
}
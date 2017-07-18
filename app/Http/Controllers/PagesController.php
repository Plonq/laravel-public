<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class PagesController extends Controller
{
    /**
     * Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('pages.home')->with('featured_movies', Movie::where('featured', true)->get());
    }

    /**
     * Movie page.
     *
     * @return \Illuminate\Http\Response
     */
    public function movies()
    {
        // Now Showing includes movies with at least one session in the next three days
        $nowshowing = Movie::whereHas('sessions', function ($query) {
            $query->where([
                ['scheduled_at', '>=', date('Y-m-d 00:00:00')],
                ['scheduled_at', '<', date('Y-m-d 00:00:00', strtotime('+4 days'))]
            ]);
        })->get();

        // Coming Soon includes movies with sessions more than three days in the future, OR
        // with release date more than 3 days in the future (in case no sessions scheduled).
        $comingsoon = Movie::whereHas('sessions', function ($query) {
            $query->where('scheduled_at', '>', date('Y-m-d 00:00:00', strtotime('+4 days')));
        })->orWhere('release_date', '>', date('Y-m-d', strtotime("+4 days")))->get();

        return view('pages.movies', ['nowshowing' => $nowshowing, 'comingsoon' => $comingsoon]);
    }

    /**
     * Search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('pages.search')->with('movies', Movie::all());
    }
}

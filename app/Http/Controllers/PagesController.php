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
        // Now Showing includes movies released up to two weeks ago and one week in the future
        $nowshowing = Movie::where([
            ['release_date', '<', date('Y-m-d', strtotime("+7 days"))],
            ['release_date', '>=', date('Y-m-d', strtotime("-14 days"))]
        ])->get();
        $comingsoon = Movie::where('release_date', '>=', date('Y-m-d', strtotime("+7 days")))->get();
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

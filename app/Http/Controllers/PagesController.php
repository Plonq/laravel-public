<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Session;
use App\Cinema;
use App\TicketType;

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
     * Movie detail/info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function movie($id)
    {
        $movie = Movie::with('genre')
            ->with('rating')
            ->where('id', $id)
            ->get()->all()[0];  // Get() returns collection with one object

        $cinemas = Cinema::all();

        return view('pages.movie', ['movie' => $movie, 'cinemas' => $cinemas]);
    }

    /**
     * Cinema detail/info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cinema($id)
    {
        $cinema = Cinema::find($id);

        $sessions = Session::with('movie')
            ->where('cinema_id', $id)
            ->orderBy('scheduled_at')
            ->get();

        return view('pages.cinema', ['cinema' => $cinema, 'sessions' => $sessions]);
    }

    /**
     * Session details and ticket purchase
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function session($id)
    {
        $session = Session::with('movie')
            ->with('cinema')
            ->where('id', $id)
            ->get()->all()[0];

        $ticket_types = TicketType::all();

        return view('pages.session', ['session' => $session, 'ticket_types' => $ticket_types]);
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

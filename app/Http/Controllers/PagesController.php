<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Session;
use App\Cinema;
use App\TicketType;
use App\Ticket;

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
            ->first();

        $cinemas = Cinema::whereHas('sessions', function($q) use ($id) {
            $q->where('movie_id', $id);
        })
            ->orderBy('city')
            ->get();

        $ticket_types = TicketType::all();

        return view('pages.movie', ['movie' => $movie, 'cinemas' => $cinemas, 'ticket_types' => $ticket_types]);
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
     * Display the user's cart
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        $cart = session('cart', false);

        if ($cart) {
            $cart_display = array();
            foreach ($cart as $session_id => $session) {
                $item['session'] = Session::with('movie')
                    ->with('cinema')
                    ->where('id', $session_id)
                    ->first();

                $tickets = array();
                foreach ($session['tickets'] as $ticket_type_id => $qty) {
                    $ticket = array();
                    $ticket['ticket_type_id'] = $ticket_type_id;
                    $ticket['ticket_type_name'] = TicketType::find($ticket_type_id)->name;
                    $ticket['ticket_type_cost'] = TicketType::find($ticket_type_id)->cost;
                    $ticket['quantity'] = $qty;
                    $tickets[] = $ticket;
                }
                $item['tickets'] = $tickets;
                $cart_display[] = $item;
            }
        }

        return view('pages.cart', ['cart' => $cart_display]);
    }

    /**
     * Search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('pages.search');
    }
}

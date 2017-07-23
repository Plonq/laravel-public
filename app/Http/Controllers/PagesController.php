<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\MovieSession;
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
        $nowshowing = Movie::whereHas('movie_sessions', function ($query) {
            $query->where([
                ['scheduled_at', '>=', date('Y-m-d 00:00:00')],
                ['scheduled_at', '<', date('Y-m-d 00:00:00', strtotime('+4 days'))]
            ]);
        })->get();

        // Coming Soon includes movies with sessions more than three days in the future, OR
        // with release date more than 3 days in the future (in case no sessions scheduled).
        $comingsoon = Movie::whereHas('movie_sessions', function ($query) {
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

        $cinemas = Cinema::whereHas('movie_sessions', function($q) use ($id) {
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

        $sessions = MovieSession::with('movie')
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

        $cart_display = array();
        $grand_total = 0.0;
        if ($cart) {
            foreach ($cart as $session_id => $session) {
                $item['session'] = MovieSession::with('movie')
                    ->with('cinema')
                    ->where('id', $session_id)
                    ->first();

                $tickets = array();
                foreach ($session['tickets'] as $ticket_type_id => $qty) {
                    $ticket = array();
                    $ticket['ticket_type_id'] = $ticket_type_id;
                    $type = TicketType::find(intval($ticket_type_id));
                    $ticket['ticket_type_name'] = $type->name;
                    $ticket['ticket_type_cost'] = $type->cost;
                    $ticket['quantity'] = $qty;
                    $tickets[] = $ticket;

                    $grand_total += ($type->cost * $qty);
                }
                $item['tickets'] = $tickets;
                $cart_display[] = $item;
            }
        }



        return view('pages.cart', ['cart' => $cart_display, 'grand_total' => $grand_total]);
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

    /**
     * Checkout page
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // Calculate total
        $grand_total = 0.0;
        foreach (session('cart') as $movie_session) {
            foreach ($movie_session['tickets'] as $ticket_type => $qty) {
                $grand_total += TicketType::find($ticket_type)->cost * intval($qty);
            }
        }

        return view('pages.checkout', ['grand_total' => $grand_total]);
    }
}

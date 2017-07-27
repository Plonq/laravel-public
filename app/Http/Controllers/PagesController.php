<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Movie;
use App\MovieSession;
use App\Cinema;
use App\TicketType;
use App\WishlistItem;
use Illuminate\Support\Facades\Auth;

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
        // If cart is empty, redirect to homepage
        if (!session('cart')) {
            return redirect()->route('home');
        }

        // Calculate total
        $grand_total = 0.0;
        foreach (session('cart') as $movie_session) {
            foreach ($movie_session['tickets'] as $ticket_type => $qty) {
                $grand_total += TicketType::find($ticket_type)->cost * intval($qty);
            }
        }

        return view('pages.checkout', ['grand_total' => $grand_total]);
    }

    /**
     * Shows logged in user's account details and wishlist
     *
     * @return \Illuminate\Http\Response
     */
    public function myaccount()
    {
        $wishlist_items = WishlistItem::where('user_id', Auth::id())
            ->with('movie')
            ->get();
        $bookings = Booking::where('user_id', Auth::id())->get();


        return view('pages.myaccount', ['wishlist_items' => $wishlist_items, 'bookings' => $bookings]);
    }
}

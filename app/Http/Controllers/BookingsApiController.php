<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class BookingsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $bookings = Booking::with('user')
            ->get()
            ->all();

        foreach ($bookings as $booking) {
            $booking['total_cost'] = $booking->total_cost;
        }

        return $bookings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function for_movie($movie_id)
    {
        // Get all bookings that have at least one ticket for provided movie
        $bookings = Booking::whereHas('tickets.movie_session', function($q) use ($movie_id) {
            $q->where('movie_id', $movie_id);
        })
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->all();

        foreach ($bookings as $booking) {
            $booking['total_cost'] = $booking->total_cost;
        }

        if (empty($bookings)) {
            return response(null, 204);
        }
        else {
            return $bookings;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function for_movie_session($movie_session_id)
    {
        // Get all bookings that have at least one ticket for provided movie session
        $bookings = Booking::whereHas('tickets', function($q) use ($movie_session_id) {
            $q->where('movie_session_id', $movie_session_id);
        })
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->all();

        foreach ($bookings as $booking) {
            $booking['total_cost'] = $booking->total_cost;
        }

        if (empty($bookings)) {
            return response(null, 204);
        }
        else {
            return $bookings;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Booking
     */
    public function show(Booking $booking)
    {
        $booking = Booking::find($booking->id)
            ->with('user')
            ->with('tickets.ticket_type.movie', 'tickets.ticket_type.cinema')
            ->first();

        $booking['total_cost'] = $booking->total_cost;

        return $booking;
    }
}

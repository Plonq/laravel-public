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
            ->get();

        foreach ($bookings->all() as $booking) {
            $booking['total_cost'] = $booking->total_cost;
        }

        return $bookings;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $booking = Booking::find($booking->id)
            ->with('tickets.ticket_type')
            ->with('user')
            ->first();

        $booking['total_cost'] = $booking->total_cost;

        return $booking;
    }
}

<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Displays details about a single booking
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        $tickets = $booking->tickets()->with('ticket_type')->get();

        return view('bookings.show', ['booking' => $booking, 'tickets' => $tickets]);
    }
}

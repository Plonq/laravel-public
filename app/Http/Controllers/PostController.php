<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Stores tickets in http session organised by movie session id
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update_cart(Request $request)
    {
        $data = $request->all();

        // Get session id and remove so we can loop over the tickets
        $session_id = $data['session_id'];
        unset($data['session_id']);

        foreach ($data as $ticket_type => $qty) {
            if ($ticket_type !== '_token'){
                if (intval($qty) > 0) {
                    $request->session()->put('cart.'.$session_id.'.tickets.'.$ticket_type, intval($qty));
                }
                else {
                    $request->session()->forget('cart.'.$session_id.'.tickets.'.$ticket_type);
                }
            }
        }

        // If no more tickets for session, remove session
        if (empty($request->session()->get('cart.'.$session_id.'.tickets'))) {
            $request->session()->forget('cart.'.$session_id);
        }

        return redirect()->route('cart');
    }

    /**
     * Stores booking in database
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:50',
            'address' => 'required|min:5',
            'city' => 'required|regex:/^[\pL\s\-]+$/u',
            'postcode' => 'required|numeric|digits:4',
            'mobile' => 'required|numeric|digits:10',
            'cc_number' => 'required|numeric|digits_between:14,16',
            'cc_expiry_month' => 'required|numeric|min:1|max:12',
            'cc_expiry_year' => 'required|numeric|min:2000|max:3000',
            'cc_cvc' => 'required|numeric|digits_between:3,4'
        ]);

    // $data =
    //  array:10 [
    //  "_token" => "wZeWBiQmbGHUjI4Xg18CrhfdQ7PE5BVrSdqtytCa"
    //  "name" => "Huon Imberger"
    //  "address" => "302/12 Waterview Walk"
    //  "city" => "Docklands"
    //  "postcode" => "3008"
    //  "mobile" => "0433288280"
    //  "cc_number" => "1111222233334444"
    //  "cc_expiry_month" => "1"
    //  "cc_expiry_year" => "2120"
    //  "cc_cvc" => "321"
//]
//        dd(session('cart'));
        // Create Booking
        $data['user_id'] = Auth::id();
        $booking = Booking::create($data);

        // Create Tickets (using the cart in the session) and link to the booking
        foreach (session('cart') as $session_id => $tickets) {
            foreach ($tickets['tickets'] as $ticket_type_id => $qty) {
                $ticket_data['movie_session_id'] = $session_id;
                $ticket_data['booking_id'] = $booking->id;
                $ticket_data['ticket_type_id'] = $ticket_type_id;
                $ticket_data['quantity'] = $qty;

                $ticket = Ticket::create($ticket_data);
            }
        }

        // Clear the cart
        $request->session()->forget('cart');

        // Flash success message to session
        $request->session()->flash('status', 'Booking created successfully');

        // Redirect to booking detail page
        return redirect()->route('booking', $booking->id);
    }
}

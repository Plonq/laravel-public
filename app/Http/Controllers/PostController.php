<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

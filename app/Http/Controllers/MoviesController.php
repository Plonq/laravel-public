<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Movie;
use App\TicketType;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display all movies
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowshowing = Movie::now_showing()->get();
        $comingsoon = Movie::coming_soon()->get();

        return view('movies.index', ['nowshowing' => $nowshowing, 'comingsoon' => $comingsoon]);
    }

    /**
     * Movie detail/info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        return view('movies.show', ['movie' => $movie, 'cinemas' => $cinemas, 'ticket_types' => $ticket_types]);
    }
}

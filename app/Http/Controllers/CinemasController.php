<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Movie;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
    /**
     * Cinema detail/info page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cinema = Cinema::find($id);

        // Find movies that have sessions scheduled in the future (ignore past sessions)
        $movies = Movie::whereHas('movie_sessions', function($q) use ($id) {
            $q->where('cinema_id', $id)
                ->where('scheduled_at', '>', date('Y-m-d H:i:s'));
        })
            ->orderBy('title')
            ->get();

        return view('cinemas.show', ['cinema' => $cinema, 'movies' => $movies]);
    }
}

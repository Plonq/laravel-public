<?php

namespace App\Http\Controllers;

use App\MovieSession;
use Illuminate\Http\Request;

class MovieSessionsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return MovieSession::with('cinema')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function for_movie($movie_id)
    {
        return MovieSession::with('cinema')
            ->where('movie_id', $movie_id)
            ->orderBy('scheduled_at')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie_session = MovieSession::create($request->all());

        if ($movie_session) {
            return response(null, 204);
        }
        else {
            return response(null, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return MovieSession
     */
    public function show(MovieSession $movie_session)
    {
        return $movie_session;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        MovieSession::find($id)->update($request->all());

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MovieSession::destroy($id);

        return response(null, 204);
    }
}

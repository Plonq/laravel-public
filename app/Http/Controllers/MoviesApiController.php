<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MoviesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $movies = Movie::with('genre')
            ->with('rating')
            ->orderBy('title')
            ->get();

        foreach ($movies->all() as $movie) {
            $movie['release_date_string'] = $movie->release_date_string;
        }

        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = Movie::create($request->all());

        if ($movie) {
            return response()->json($movie, 201);
        }
        else {
            return response()->json(['error' => 'Could not create movie'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Movie $movie
     * @return Movie
     */
    public function show(Movie $movie)
    {
        $movie = Movie::with('genre')
            ->with('rating')
            ->where('id', $movie->id)
            ->first();
        $movie['release_date_string'] = $movie->release_date_string;
        return $movie;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movie::destroy($id);

        return response()->json(['message' => 'Movie deleted successfully'], 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Movie;
use App\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies_comingsoon = Movie::coming_soon()->pluck('title', 'id')->all();

        return view('wishlist.create', compact('movies_comingsoon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'movie_id' => 'required',
            'comment' => 'required',
        ]);

        $data = $request->all();

        // Create wishlist item
        $data['user_id'] = Auth::id();
        WishlistItem::create($data);

        $request->session()->flash('message', 'Successfully added movie to your wish list.');
        return redirect()->route('myaccount');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishlist_item = WishlistItem::find($id);
        $movies_comingsoon = Movie::coming_soon()->pluck('title', 'id')->all();

        return view('wishlist.edit', ['wishlist_item' => $wishlist_item, 'movies_comingsoon' => $movies_comingsoon]);
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
        $this->validate($request, [
            'movie_id' => 'required',
            'comment' => 'required',
        ]);

        // Don't need to add user_id here because we're updating an existing item

        WishlistItem::find($id)->update($request->all());
        $request->session()->flash('message', 'Successfully saved changes.');
        return redirect()->route('myaccount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WishlistItem::destroy($id);

        session()->flash('message', 'Successfully deleted item.');
        return redirect()->route('myaccount');
    }
}

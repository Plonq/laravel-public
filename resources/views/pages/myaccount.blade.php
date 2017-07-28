@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>My Account</h3>
    </header>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <label class="col-sm-2 text-right">Account Name:</label>
                <div class="col-sm-10">
                    <p>{{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 text-right">Account Email:</label>
                <div class="col-sm-10">
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Bookings</h4>
            @if ($bookings->isEmpty())
                <p>You have not made any bookings. Why don't you check out the <a href="{{ route('movies') }}">Movies</a> page?</p>
            @else
                @component('bookings.table', ['bookings' => $bookings->all()])
                @endcomponent
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Movie Wish List</h4>

            @if (session('message'))
                <div class="alert alert-info">
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            @if ($wishlist_items->isEmpty())
                <p>You do not have any movies on your wish list.</p>
            @else
                @component('wishlist.index', ['wishlist_items' => $wishlist_items->all()])
                @endcomponent
            @endif
            <a role="button" class="btn btn-default" href="{{ route('wishlist.create') }}">Add Movie</a>
        </div>
    </div>
@endsection
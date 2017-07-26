@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>My Account</h3>
    </header>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="account-name" class="col-sm-2 control-label">Account Name:</label>
                    <div class="col-sm-10">
                        <p class="form-control-static" id="account-name">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account-email" class="col-sm-2 control-label">Account Email:</label>
                    <div class="col-sm-10">
                        <p class="form-control-static" id="account-email">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Bookings</h4>
            @if (empty($bookings))
                <p>You have not made any bookings. Why don't you check out the <a href="{{ route('movies') }}">Movies</a> page?</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @include('wishlist.index')
        </div>
    </div>
@endsection

@section('scripts')
@endsection
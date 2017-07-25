@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Booking</h3>
    </header>
    @if (session('status'))
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-success">
                    <p>{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="form-horizontal">
        <div class="form-group">
            <label for="booking-id" class="col-sm-2 control-label">Booking ID:</label>
            <div class="col-sm-10">
                <p class="form-control-static" id="booking-id">{{ $booking->id }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-10">
                <p class="form-control-static" id="name">{{ $booking->name }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address:</label>
            <div class="col-sm-10">
                <p class="form-control-static" id="address">{{ $booking->address }}<br>{{ $booking->city }}, {{ $booking->postcode }}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="cc-number" class="col-sm-2 control-label">Credit Card Used:</label>
            <div class="col-sm-10">
                <p class="form-control-static" id="cc-number">{{ sprintf('XXXX XXXX XXXX %s', substr($booking->cc_number, -4)) }}</p>
            </div>
        </div>
    </div>
@endsection
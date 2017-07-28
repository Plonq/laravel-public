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
        <div class="row">
            <label class="col-sm-2 text-right">Booking ID:</label>
            <div class="col-sm-10">
                <p>{{ $booking->id }}</p>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 text-right">Name:</label>
            <div class="col-sm-10">
                <p>{{ $booking->name }}</p>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 text-right">Address:</label>
            <div class="col-sm-10">
                <p>{{ $booking->address }}<br>{{ $booking->city }}, {{ $booking->postcode }}</p>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 text-right">Credit Card Used:</label>
            <div class="col-sm-10">
                <p>{{ sprintf('XXXX XXXX XXXX %s', substr($booking->cc_number, -4)) }}</p>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 text-right">Total Cost:</label>
            <div class="col-sm-10">
                <p>{{ sprintf('$%.2f', ($booking->total_cost)) }}</p>
            </div>
        </div>

    <h4>Tickets</h4>
    @component('tickets.table', ['tickets' => $tickets->all()])
    @endcomponent
@endsection
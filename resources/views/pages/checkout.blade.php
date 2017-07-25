@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Checkout</h3>
    </header>
    <form id="checkout-form" method="post" action="{{route('purchase_tickets')}}">
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-4">
                <h4>Billing Details</h4>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input class="form-control" id="city" name="city" placeholder="City" value="{{ old('city') }}">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input class="form-control" id="postcode" name="postcode" placeholder="Postcode" value="{{ old('postcode') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input class="form-control" id="mobile" name="mobile" placeholder="e.g. 0411222333" value="{{ old('mobile') }}">
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Payment Details</h4>
                <div class="form-group">
                    <label for="cc-number">Credit Card Number</label>
                    <input class="form-control" id="cc-number" name="cc-number" placeholder="e.g. 1111222233334444" value="{{ old('cc-number') }}">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="cc-expiry-month">Expiry Month</label>
                        <input class="form-control" id="cc-expiry-month" name="cc-expiry-month" value="{{ old('cc-expiry-month') }}">
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc-expiry-year">Expiry Year</label>
                            <input class="form-control" id="cc-expiry-year" name="cc-expiry-year" value="{{ old('cc-expiry-year') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc-cvc">CVC</label>
                            <input class="form-control" id="cc-cvc" name="cc-cvc" placeholder="e.g. 123" value="{{ old('cc-cvc') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Grand Total</h5>
                    </div>
                    <div class="panel-body">
                        <strong style="font-size: 3em">{{sprintf('$%.2f', $grand_total)}}</strong>
                    </div>
                </div>
                <button type="submit" class="btn-block btn btn-success">Pay and Submit Booking</button>
            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="row">
            <div class="col-sm-8">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        $('#checkout-form').validate({
            rules: {
                'cc-number': {
                    required: true,
                    creditcard: true
                }
            }
        });
    </script>
@endsection
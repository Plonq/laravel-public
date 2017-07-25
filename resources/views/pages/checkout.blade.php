@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Checkout</h3>
    </header>
    <form id="checkout-form" method="post" action="{{route('checkout')}}">
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
                    <label for="cc_number">Credit Card Number</label>
                    <input class="form-control" id="cc_number" name="cc_number" placeholder="e.g. 1111222233334444" value="{{ old('cc_number') }}">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc_expiry_month">Expiry Month</label>
                            <input type="number" class="form-control" id="cc_expiry_month" name="cc_expiry_month" value="{{ old('cc_expiry_month') }}" min="1" max="12">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc_expiry_year">Expiry Year</label>
                            <input type="number" class="form-control" id="cc_expiry_year" name="cc_expiry_year" value="{{ old('cc_expiry_year') }}" min="2000" max="3000">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cc_cvc">CVC</label>
                            <input class="form-control" id="cc_cvc" name="cc_cvc" placeholder="e.g. 123" value="{{ old('cc_cvc') }}">
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
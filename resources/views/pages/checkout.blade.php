@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Checkout</h3>
    </header>
    <form id="checkout-form">
        <div class="row">
            <div class="col-sm-8">
                <h4>Billing Info</h4>
                <div class="form-group">
                    <label for="billing-name">Name</label>
                    <input class="form-control" id="billing-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="billing-address">Address</label>
                    <input class="form-control" id="billing-address" placeholder="Address">
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="billing-city">City</label>
                            <input class="form-control" id="billing-city" placeholder="City">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="billing-postcode">Postcode</label>
                            <input class="form-control" id="billing-postcode" placeholder="Postcode" maxlength="4">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="billing-mobile">Mobile Number</label>
                    <input class="form-control" id="billing-mobile" placeholder="e.g. 0411222333">
                </div>
                <div class="form-group">
                    <label for="billing-cc-number">Credit Card Number</label>
                    <input class="form-control" id="billing-cc-number" placeholder="e.g. 1111222233334444">
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="billing-cc-number">Credit Card Expiry</label>
                            <input class="form-control" id="billing-cc-number" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="billing-cc-number">Credit Card CVC</label>
                            <input class="form-control" id="billing-cc-number" placeholder="e.g. 123">
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
                <button type="submit" class="btn-block btn btn-success" href="#">Pay and Submit Booking</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('#checkout-form').validate({
            submitHandler: function (form) {
                var data = $(form).serialize();

                // TODO
            }
        });
    </script>
@endsection
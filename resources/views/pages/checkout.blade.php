@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Checkout</h3>
    </header>
    {!! Form::open(['id' => 'checkout-form', 'route' => 'checkout', 'method'=>'POST']) !!}
        <div class="row">
            <div class="col-sm-4">
                <h4>Billing Details</h4>
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            {!! Form::label('city', 'City') !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            {!! Form::label('postcode', 'Postcode') !!}
                            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('mobile', 'Mobile Number') !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'e.g. 0411222333']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Payment Details</h4>
                <div class="form-group">
                    {!! Form::label('cc_number', 'Credit Card Number') !!}
                    {!! Form::text('cc_number', null, ['class' => 'form-control', 'placeholder' => 'e.g. 1111222233334444']) !!}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('cc_expiry_month', 'Expiry Month') !!}
                            {!! Form::text('cc_expiry_month', null, ['class' => 'form-control', 'min' => '1', 'max' => '12']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('cc_expiry_year', 'Expiry Year') !!}
                            {!! Form::text('cc_expiry_year', null, ['class' => 'form-control', 'min' => '2000', 'max' => '3000']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('cc_cvc', 'CVC') !!}
                            {!! Form::text('cc_cvc', null, ['class' => 'form-control', 'placeholder' => 'e.g. 123']) !!}
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
                {!! Form::submit('Pay and Submit Booking', ['class' => 'btn-block btn btn-success']) !!}
            </div>
        </div>
    {!! Form::close() !!}
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
@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Your Cart</h3>
    </header>
    {{--<pre>--}}
        {{--@php(var_dump($cart))--}}
    {{--</pre>--}}
    @if (empty($cart))
        <p>There are no items in your cart.</p>
    @else
        <div class="row">
            <div class="col-sm-8">
                @foreach ($cart as $item)
                    {!! Form::open(['route' => 'update_cart', 'method'=>'POST']) !!}
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <strong>{{$item['session']->movie->title}}</strong><br>
                                <strong>Cinema:</strong> {{$item['session']->cinema->city}}<br>
                                <strong>Date:</strong> {{$item['session']->scheduled_date_string}}<br>
                                <strong>Time:</strong> {{$item['session']->scheduled_time_string}}
                            </div>

                            <table class="table table-default">
                                <thead>
                                <tr>
                                    <th>Ticket Type</th>
                                    <th>Quantity</th>
                                    <th>Ticket Cost</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($item['tickets'] as $ticket)
                                    @if (intval($ticket['quantity']) > 0)
                                        <tr>
                                            <td>{{$ticket['ticket_type_name']}}</td>
                                            <td>
                                                {!! Form::number($ticket['ticket_type_id'], $ticket['quantity'], ['class' => 'form-control input-sm', 'style' => 'width:auto', 'min' => '0', 'max' => '20']) !!}
                                            </td>
                                            <td>{{sprintf('$%.2f', ($ticket['ticket_type_cost']))}}</td>
                                            <td>{{sprintf('$%.2f', ($ticket['ticket_type_cost'] * intval($ticket['quantity'])))}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            <div class="panel-footer clearfix">
                                To remove an item, reduce its quantity to zero.
                                <input hidden name="session_id" value="{{$item['session']->id}}">
                                {!! Form::submit('Update Quantities', ['class' => 'pull-right btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endforeach
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
                <a role="button" class="btn-block btn btn-success" href="{{route('checkout')}}">Checkout</a>
            </div>
        </div>
    @endif
@endsection
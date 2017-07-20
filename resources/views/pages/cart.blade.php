@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Your Cart</h3>
    </header>
    {{--<pre>--}}
        {{--@php(var_dump($cart))--}}
    {{--</pre>--}}
    <div class="row">
        <div class="col-sm-8">
            @foreach ($cart as $item)
                <form role="form" class="cart-update-form">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <strong>Movie:</strong> {{$item['session']->movie->title}}<br>
                            <strong>Cinema:</strong> {{$item['session']->cinema->city}}<br>
                            <strong>Date:</strong> {{$item['session']->scheduled_at}}
                        </div>

                        <table class="table table-default">
                            <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Quantity</th>
                                <th>Ticket Cost</th>
                                <th>Total</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($item['tickets'] as $ticket => $qty)
                                @if (intval($qty) > 0)
                                    <tr>
                                        <td>{{$ticket_types[$ticket]->name}}</td>
                                        <td><input type="number" style='width:auto' class="form-control input-sm" value="{{$qty}}" max="20" min="1"></td>
                                        <td>{{sprintf('$%.2f', ($ticket_types[$ticket]->cost))}}</td>
                                        <td>{{sprintf('$%.2f', ($ticket_types[$ticket]->cost * intval($qty)))}}</td>
                                        <td>delete</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="col-xs-4">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">

        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
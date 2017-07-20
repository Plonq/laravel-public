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
                            <strong>{{$item['session']->movie->title}}</strong><br>
                            <strong>Cinema:</strong> {{$item['session']->cinema->city}}<br>
                            <strong>Date:</strong> {{$item['session']->date}}<br>
                            <strong>Time:</strong> {{$item['session']->time}}
                        </div>

                        <table class="table table-default">
                            <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Quantity</th>
                                <th>Ticket Cost</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($item['tickets'] as $ticket => $qty)
                                @if (intval($qty) > 0)
                                    <tr>
                                        <td>{{$ticket_types[$ticket]->name}}</td>
                                        <td><input type="number" name="{{$ticket}}" style='width:auto' class="form-control input-sm" value="{{$qty}}" max="20" min="0"></td>
                                        <td>{{sprintf('$%.2f', ($ticket_types[$ticket]->cost))}}</td>
                                        <td>{{sprintf('$%.2f', ($ticket_types[$ticket]->cost * intval($qty)))}}</td>
                                        <td><button value="{{$ticket}}" type="button" class="btn btn-xs btn-danger delete-button"><span class="glyphicon glyphicon-remove"></span></button></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        <div class="panel-footer">
                            <input hidden name="session_id" value="{{$item['session']->id}}">
                            <button type="submit" class="btn btn-primary">Update Quantities</button>
                        </div>
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
        // AJAX to update cart with new quantities or remove ticket types
        $('.cart-update-form').each(function () {
            $(this).validate({
                submitHandler: function (form) {
                    var data = $(form).serialize();

                    $.ajax({
                        method: 'POST',
                        url: '/updatecart',
                        data: data,
                        success: function (response) {
                            console.log(response);


                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });

                    location.reload();
                }
            })
        });
    </script>
@endsection
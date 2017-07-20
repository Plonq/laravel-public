@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Movie Info</h3>
    </header>
    <div class="row">
        <div class="col-xs-5">
            <img src="{{asset('media/movie_art/'.$movie->id.'_poster.jpg')}}" width="100%">
        </div>
        <div class="col-xs-7">
            <div class="row">
                <div class="col-sm-12">
                    <h4>{{$movie->title}}</h4>
                    <p>
                        <strong>Rating</strong><br>
                        {{$movie->rating->code}} ({{$movie->rating->name}})
                    </p>
                    <p>
                        <strong>Release Date</strong><br>
                        {{date('l, j F Y', strtotime($movie->release_date))}}
                    </p>
                    <p>
                        <strong>Genre</strong><br>
                        {{$movie->genre->name}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h4>Buy Tickets</h4>
    <div class="row">
        <div class="col-sm-6">
            <form id="choose-cinema-form">
                <div class="form-group">
                    <label for="cinema-select" class="control-label">Choose a cinema: </label>
                    <select id="cinema-select" class="form-control" name="cinema_id">
                        <option selected disabled hidden style='display: none' value=''></option>
                        @foreach ($cinemas as $cinema)
                            <option value="{{$cinema->id}}">{{$cinema->city}}</option>
                        @endforeach
                    </select>
                    <input hidden name="movie_id" value="{{$movie->id}}">
                </div>
            </form>
            <form hidden id="choose-tickets-form">
                <div class="form-group">
                    <label for="session-select" class="control-label">Choose a session: </label>
                    <select id="session-select" class="form-control" name="session_id">

                    </select>
                </div>
                <div hidden id="ticket-quanity-lines">
                    <div class="form-horizontal">
                        @foreach ($ticket_types as $ticket_type)
                            <div class="form-group">
                                <label for="{{$ticket_type->name}}" class="col-sm-4 control-label">{{$ticket_type->name}}</label>
                                <label for="{{$ticket_type->name}}" class="col-sm-4 control-label">{{sprintf('$%.2f', $ticket_type->cost)}}</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="{{$ticket_type->name}}" name="{{$ticket_type->id}}">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div id="addtocart-button" class="col-sm-12">
                                <button class="btn btn-default pull-right" type="submit">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#cinema-select').change(function() {
            data = $('#choose-cinema-form').serialize();

            $.ajax({
                method: 'POST',
                url: '/sessions',
                data: data,
                success: function (response) {
                    // Display sessions for chosen cinema
                    var sessions = JSON.parse(response);
                    $('#session-select').empty();

                    $('#session-select').append("<option selected disabled hidden style='display: none' value=''></option>");

                    $.each(sessions, function (i, session) {
                        var option = "<option value='" + session.id + "'>" + session.date + "  " + session.time + "</option>";
                        $('#session-select').append(option);
                    });

                    $('#choose-tickets-form').show();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });

        $('#session-select').change(function() {
            $('#ticket-quanity-lines').show();
        });

        $('#choose-tickets-form').validate({
            submitHandler: function (form) {
                var data = $(form).serialize();
                // Add session id to data
                data += '&session_id='+

                $.ajax({
                    method: 'POST',
                    url: '/cart',
                    data: data,
                    success: function (response) {
                        console.log(response);

                        // Replace Add to cart button with link to cart
                        $('#addtocart-button').empty();
                        $('#addtocart-button').html('<div class="pull-right"><a href="/cart">View Cart</a></div>');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            }
        })
    </script>
@endsection
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
        <div class="col-sm-6 col-md-4">
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
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Buy Tickets</th>
                </tr>
                </thead>
                <tbody id="session-rows">
                </tbody>
            </table>
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
                    console.log(response);

                    // Display sessions for chosen cinema

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Search Movies/Cinemas</h3>
    </header>
    <div class="row">
        <div class="col-sm-6">
            <form class="form" id="movie-search-form">
                {{ csrf_field() }}
                <div class="input-group">
                    <input id="movie-search-field" name="search-term" type="text" class="form-control" placeholder="Enter search term...">
                    <span class="input-group-btn">
                        <button id="movie-search-button" class="btn btn-default" type="submit">Search</button>
                    </span>
                </div>
            </form>
            <br>
        </div>
    </div>
    <div class="row">
        <div id="movies-table" class="col-md-12" hidden>
            <h3>Movies</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Release Date</th>
                    <th>Info</th>
                </tr>
                </thead>
                <tbody id="movie-results">
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="row">
        <div id="cinemas-table" class="col-md-12" hidden>
            <h3>Cinemas</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Address</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Info</th>
                </tr>
                </thead>
                <tbody id="cinema-results">
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#movie-search-form').validate({
            submitHandler: function (form) {
                var serializedData = $(form).serialize();

                $.ajax({
                    method: 'POST',
                    url: '/search',
                    data: serializedData,
                    success: function (response) {
                        // Display movie search results
                        $('#movie-results').empty();
                        var movies = JSON.parse(response).movies;
                        if (movies.length !== 0) {
                            $('#movies-table').show();
                            $.each(movies, function (i, movie) {
                                var movie_row_html = $([
                                    "<tr>",
                                    "  <td>" + movie.title + "</td>",
                                    "  <td>" + movie.genre + "</td>",
                                    "  <td>" + movie.rating + " (" + movie.rating_code + ")</td>",
                                    "  <td>" + movie.release_date + "</td>",
                                    "  <td><a class='btn btn-sm btn-default' role='button' href='/movie/" + movie.id + "'>Info/Sessions</a></td>",
                                    "</tr>"
                                ].join("\n"));
                                $('#movie-results').append(movie_row_html);
                            });
                        }
                        else {
                            $('#movies-table').hide();
                        }

                        // Display cinema search results
                        $('#cinema-results').empty();
                        var cinemas = JSON.parse(response).cinemas;
                        if (cinemas.length !== 0) {
                            $('#cinemas-table').show()
                            $.each(cinemas, function (i, cinema) {
                                var cinema_row_html = $([
                                    "<tr>",
                                    "  <td>" + cinema.address + "</td>",
                                    "  <td>" + cinema.city + "</td>",
                                    "  <td>" + cinema.postcode + "</td>",
                                    "  <td><a class='btn btn-sm btn-default' role='button' href='/cinema/" + cinema.id + "'>Info/Sessions</a></td>",
                                    "</tr>"
                                ].join("\n"));
                                $('#cinema-results').append(cinema_row_html);
                            });
                        }
                        else {
                            $('#cinemas-table').hide();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            }
        });
    </script>
@endsection
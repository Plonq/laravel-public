@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form class="form" id="movie-search-form">
                {{ csrf_field() }}
                <div class="input-group">
                    <input id="movie-search-field" name="search-term" type="text" class="form-control" placeholder="Search for title, genre, ...">
                    <span class="input-group-btn">
                        <button id="movie-search-button" class="btn btn-default" type="submit">Search</button>
                    </span>
                </div>
            </form>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Release Date</th>
                    <th>Buy Tickets</th>
                </tr>
                </thead>
                <tbody id="search-results">
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
                        console.log(response);

                        // Insert search results into table
                        $('#search-results').empty();
                        var movies = JSON.parse(response);
                        $.each(movies, function(i,movie) {
                            var movie_row_html = $([
                                "<tr>",
                                "  <td>"+movie.title+"</td>",
                                "  <td>"+movie.genre+"</td>",
                                "  <td>"+movie.rating+" ("+movie.rating_code+")</td>",
                                "  <td>"+movie.release_date+"</td>",
                                "  <td><a class='btn btn-sm btn-default' role='button' href='#"+movie.id+"'>Buy Tickets</a></td>",
                                "</tr>"
                            ].join("\n"));
                            $('#search-results').append(movie_row_html);
                        });
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
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="featured-movie-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($featured_movies as $movie)
                        <li data-target="#featured-movie-carousel" data-slide-to="{{$loop->index}}" {!! $loop->first ? 'class="active"' : '' !!}></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach($featured_movies as $movie)
                        <div class="item {!! $loop->first ? 'active' : '' !!}">
                            <a href="{{ route('movie', $movie->id) }}">
                                <img src="{{ $movie->cover_path }}">
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#featured-movie-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#featured-movie-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>


    <h3>Take the family to the cinema today!</h3>
@endsection

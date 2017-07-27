@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Cinema Info</h3>
    </header>
    <div class="row">
        <div class="col-xs-7">
            <h4>{{$cinema->city}}</h4>
            <p>
                <address>
                    {{$cinema->address}}<br>
                    {{$cinema->city}}, {{$cinema->postcode}}<br>
                </address>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h4>Movies</h4>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Release Date</th>
                    <th>Sessions/Info</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{$movie->title}}</td>
                        <td>{{$movie->genre->name}}</td>
                        <td>{{$movie->rating->name}} ({{$movie->rating->code}})</td>
                        <td>{{$movie->release_date_string}}</td>
                        <td><a class="btn btn-sm btn-default" role='button' href="{{route('movie', $movie->id)}}">Sessions/Info</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
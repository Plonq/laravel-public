@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Release Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{$movie->title}}</td>
                        <td>{{$movie->genre->name}}</td>
                        <td>{{$movie->rating->name}} ({{$movie->rating->code}})</td>
                        <td>{{$movie->release_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

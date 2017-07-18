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
            <h4>Sessions</h4>
            <table class="table">
                <thead>
                <tr>
                    <th>Session Time</th>
                    <th>Movie</th>
                    <th>Buy Tickets</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{$session->scheduled_at}}</td>
                        <td>{{$session->movie->title}}</td>
                        <td><a class="btn btn-sm btn-default" role="button" href="{{route('session', $session->id)}}">Buy Tickets</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
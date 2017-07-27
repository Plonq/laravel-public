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
            @if ($movies->isEmpty())
                <p>Sorry, no movies currently showing at this cinema.</p>
            @else
                @component('movies.table', ['movies' => $movies->all()])
                @endcomponent
            @endif
        </div>
    </div>
@endsection
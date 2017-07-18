@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Purchase Tickets</h3>
    </header>
    <div class="row">
        <div class="col-sm-6 col-sm-push-6">
            <div class="row">
                <div class="col-xs-5">
                    <img src="{{asset('media/movie_art/'.$session->movie->id.'_poster.jpg')}}" width="100%">
                </div>
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>{{$session->movie->title}} <small>{{$session->movie->rating->code}}</small></h6>
                            <p>
                                <strong>Date</strong><br>
                                {{date('l, j F Y', strtotime($session->scheduled_at))}}
                            </p>
                            <p>
                                <strong>Time</strong><br>
                                {{date('g:i A', strtotime($session->scheduled_at))}}
                            </p>
                            <p>
                                <strong>Cinema</strong><br>
                                {{$session->movie->genre->name}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-sm-pull-6">
            <form class="form-horizontal" id="ticket-form">
                @foreach ($ticket_types as $ticket_type)
                    <div class="form-group">
                        <label for="student" class="col-sm-4 control-label">{{$ticket_type->name}}</label>
                        <label for="student" class="col-sm-4 control-label">{{sprintf('$%.2f', $ticket_type->cost)}}</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="student" name="student">
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
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
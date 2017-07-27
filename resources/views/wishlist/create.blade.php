@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Add Movie to Wish List</h3>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Please correct the following problems:</p>
            <p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </p>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['route' => 'wishlist.store', 'method'=>'POST']) !!}
            @include('wishlist.form')
            <button type="submit" class="pull-right btn btn-success">Add Movie to Wish List</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
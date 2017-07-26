@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Edit Wish List Item</h3>
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
            {!! Form::model($wishlist_item, ['method' => 'PATCH','route' => ['wishlist.update', $wishlist_item->id]]) !!}
            @include('wishlist.form')
            <button type="submit" class="pull-right btn btn-success">Save Changes</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
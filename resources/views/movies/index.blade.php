@extends('layouts.app')

@section('content')
    <header class="page-header">
        <h3>Movies</h3>
    </header>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#nowshowing" aria-controls="nowshowing" role="tab" data-toggle="tab">Now Showing</a></li>
                <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab">Coming Soon</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="nowshowing">
                    @component('movies.table', ['movies' => $nowshowing])
                    @endcomponent
                </div>
                <div role="tabpanel" class="tab-pane" id="comingsoon">
                    @component('movies.table', ['movies' => $comingsoon])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

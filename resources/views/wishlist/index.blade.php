<h4>Movie Wish List</h4>
@if (session('message'))
    <div class="alert alert-info">
        <p>{{ session('message') }}</p>
    </div>
@endif

@if (empty($wishlist_items))
    <p>There are no items on your wish list.</p>
@else
    <table class="table">
        <thead>
        <tr>
            <th>Movie</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($wishlist_items as $wishlist_item)
            <tr>
                <td>{{ $wishlist_item->movie->title }}</td>
                <td>{{ $wishlist_item->comment }}</td>
                <td>
                    <a role="button" class="btn btn-sm btn-primary" href="{{ route('wishlist.edit', $wishlist_item->id) }}">Edit</a>
                    {{--<form id="delete-wishlist-item-form" style="display:inline" action="{{ route('wishlist.destroy', $wishlist_item->id) }}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<button type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
                    {{--</form>--}}
                    {!! Form::open(['method' => 'DELETE','route' => ['wishlist.destroy', $wishlist_item->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
<a role="button" class="btn btn-default" href="{{ route('wishlist.create') }}">Add Movie</a>
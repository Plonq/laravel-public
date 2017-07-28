<table class="table">
    <thead>
    <tr>
        <th>Booking ID</th>
        <th>Name</th>
        <th>Total</th>
        <th>Details</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->name }}</td>
            <td>{{ sprintf('$%.2f', ($booking->total_cost)) }}</td>
            <td><a class="btn btn-sm btn-default" role='button' href="{{route('booking', $booking->id)}}">Details</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
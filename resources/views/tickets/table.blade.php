<table class="table table-default">
    <thead>
    <tr>
        <th>Ticket Type</th>
        <th>Quantity</th>
        <th>Ticket Cost</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($tickets as $ticket)
        @if (intval($ticket->quantity) > 0)
            <tr>
                <td>{{ $ticket->ticket_type->name }}</td>
                <td>
                    {{ $ticket->quantity }}
                </td>
                <td>{{ sprintf('$%.2f', ($ticket->ticket_type->cost)) }}</td>
                <td>{{ sprintf('$%.2f', ($ticket->ticket_type->cost * intval($ticket->quantity))) }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
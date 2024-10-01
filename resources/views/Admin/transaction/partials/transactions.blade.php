@foreach ($transactions as $transaction)
    <tr>
        <td>{{ $transaction->id }}</td>
        <td>{{ $transaction->account_id }}</td>
        <td>{{ ucfirst($transaction->transaction_type) }}</td>
        <td>${{ number_format($transaction->amount) }}</td>
        <td>{{ $transaction->date }}</td>
        <td>{{ ucfirst($transaction->status) }}</td>
        @if(Auth::user()->role === 'customer')
            <td>
                <a href="{{ route('transactions.downloadPDF', $transaction->id) }}" class="btn btn-success btn-sm">PDF</a>
            </td>
        @endif
        @if(Auth::user()->role === 'admin')
            <td>
                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-success btn-sm">Edit</a>
                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        @endif
    </tr>
@endforeach

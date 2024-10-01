<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Transaction</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }

        .container {
            max-width: 600px;
        }

        .card-body p {
            font-size: 1.1rem;
        }

        .card-body .btn {
            margin-top: 1rem;
            font-size: 1.1rem;
        }

        .card {
            margin-bottom: 20px;
        }

        .btn-secondary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-secondary:hover,
        .btn-secondary:active,
        .btn-secondary:focus {
            background-color: #0056b3 !important;
            border-color: #004085 !important;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $transaction->account->user_id))
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Transaction Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
                <p><strong>Account Number:</strong> {{ $transaction->account->account_number }}</p>
                <p><strong>Transaction Type:</strong> {{ ucfirst($transaction->transaction_type) }}</p>
                <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
                <p><strong>Date:</strong> {{ $transaction->date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            <p>You do not have permission to access this page.</p>
        </div>
    @endif
</div>
</body>
</html>

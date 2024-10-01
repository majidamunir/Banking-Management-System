<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transactions Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<h1>Transactions Report</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Account ID</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->account_id }}</td>
            <td>{{ ucfirst($transaction->transaction_type) }}</td>
            <td>${{ number_format($transaction->amount, 2) }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ ucfirst($transaction->status) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

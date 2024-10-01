<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #ffffff;
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .card-body {
            font-size: 1rem;
            line-height: 1.6;
            padding: 15px;
        }
        .card-body table {
            width: 100%;
            border-collapse: collapse;
        }
        .card-body th, .card-body td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .card-body th {
            background-color: #f4f4f4;
            text-align: left;
        }
        .card-body td {
            text-align: left;
        }
        .card-title {
            margin: 0;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card-header">
        <h4 class="card-title">Transaction Details</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <th>Transaction ID:</th>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <th>Account ID:</th>
                <td>{{ $transaction->account_id }}</td>
            </tr>
            <tr>
                <th>Transaction Type:</th>
                <td>{{ ucfirst($transaction->transaction_type) }}</td>
            </tr>
            <tr>
                <th>Amount:</th>
                <td>${{ number_format($transaction->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Date:</th>
                <td>{{ $transaction->date }}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{{ ucfirst($transaction->status) }}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>

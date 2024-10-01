<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .container {
            max-width: 600px;
        }
        .btn-back {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Account Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Account ID:</strong> {{ $account->id }}</p>
            <p><strong>Account Type:</strong> {{ ucfirst($account->account_type) }}</p>
            <p><strong>Balance:</strong> ${{ number_format($account->balance, 2) }}</p>
            <p><strong>Account Number:</strong> {{ $account->account_number }}</p>
            <p><strong>Status:</strong> {{ ucfirst($account->status) }}</p>
            <a href="{{ route('accounts.index') }}" class="btn btn-primary btn-back">Back</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

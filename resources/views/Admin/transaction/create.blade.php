<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control {
            border-color: #007bff;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .container {
            max-width: 800px;
        }
        .btn-submit {
            display: inline-block;
            margin-top: 1rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    @if(Auth::check() && Auth::user()->role === 'admin')

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display Error Message -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Transaction</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="account_id">Account</label>
                        <select name="account_id" id="account_id" class="form-control" required>
                            @foreach(App\Models\Account::all() as $account)
                                <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="transaction_type">Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control" required>
                            <option value="deposit">Deposit</option>
                            <option value="withdrawal">Withdrawal</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <!-- <option value="failed">Failed</option> Uncomment if needed -->
                        </select>
                    </div>

                    <!-- Target Account ID field, shown only for transfer transactions -->
                    <div class="form-group" id="target-account-group" style="display: none;">
                        <label for="target_account_id">Target Account</label>
                        <select name="target_account_id" id="target_account_id" class="form-control">
                            <option value="">Select Target Account</option>
                            @foreach(App\Models\Account::all() as $account)
                                <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-submit">Create Transaction</button>
                        <a href="{{ Auth::user()->role === 'admin' ? route('transactions.index') : route('home') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Script to show/hide target account field based on transaction type -->
        <script>
            document.getElementById('transaction_type').addEventListener('change', function() {
                var targetAccountGroup = document.getElementById('target-account-group');
                if (this.value === 'transfer') {
                    targetAccountGroup.style.display = 'block';
                } else {
                    targetAccountGroup.style.display = 'none';
                }
            });
        </script>

    @else
        <p>You do not have permission to access this page.</p>
    @endif
</div>
</body>
</html>

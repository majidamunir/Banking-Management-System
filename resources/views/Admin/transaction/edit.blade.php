<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
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
    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $transaction->account->user_id))

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
                <h4 class="card-title mb-0">Edit Transaction</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="account_id">Account</label>
                        <select name="account_id" id="account_id" class="form-control" required>
                            @foreach(App\Models\Account::all() as $account)
                                <option value="{{ $account->id }}" {{ $transaction->account_id == $account->id ? 'selected' : '' }}>
                                    {{ $account->account_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="transaction_type">Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control" required>
                            <option value="deposit" {{ $transaction->transaction_type == 'deposit' ? 'selected' : '' }}>Deposit</option>
                            <option value="withdrawal" {{ $transaction->transaction_type == 'withdrawal' ? 'selected' : '' }}>Withdrawal</option>
                            <option value="transfer" {{ $transaction->transaction_type == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>

                    <!-- Target Account Field (only visible for transfers) -->
                    <div class="form-group" id="target_account_field" style="{{ $transaction->transaction_type !== 'transfer' ? 'display: none;' : '' }}">
                        <label for="target_account_id">Target Account</label>
                        <select name="target_account_id" id="target_account_id" class="form-control">
                            @foreach(App\Models\Account::where('id', '!=', $transaction->account_id)->get() as $account)
                                <option value="{{ $account->id }}" {{ $transaction->target_account_id == $account->id ? 'selected' : '' }}>
                                    {{ $account->account_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ $transaction->amount }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-submit">Update Transaction</button>
                        <a href="{{ Auth::user()->role === 'admin' ? route('transactions.index') : route('home') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p>You do not have permission to access this page.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transactionTypeSelect = document.getElementById('transaction_type');
        const targetAccountField = document.getElementById('target_account_field');

        transactionTypeSelect.addEventListener('change', function () {
            if (this.value === 'transfer') {
                targetAccountField.style.display = 'block';
            } else {
                targetAccountField.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>

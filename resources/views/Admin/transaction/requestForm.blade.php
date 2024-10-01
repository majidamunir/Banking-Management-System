<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Request Form</title>
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

        .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus,
        .btn-primary:visited {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .form-description {
            margin-bottom: 1rem;
        }

        .d-none {
            display: none;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Transaction Request</h4>
        </div>
        <div class="card-body">
            <div class="form-description">
                <h5 style="color: #007bff" class="font-weight-bold">Purpose of this Form</h5>
                <p>This form allows customers to submit a request for a transaction. Please select the type of transaction (Deposit, Withdraw, or Transfer), specify the amount, and choose the account. The admin will review your request and process it accordingly.</p>
            </div>

            <form action="{{ route('transaction.request.store') }}" method="POST">
                @csrf

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Account Field -->
                <div class="form-group mb-3">
                    <label for="account_id" class="form-label">Account</label>
                    <select class="form-control @error('account_id') is-invalid @enderror" id="account_id" name="account_id" required>
                        <option value="" disabled selected>Select Account</option>
                        @foreach ($activeAccounts as $account)
                            @if ($user->role !== 'customer' || $account->user_id === $user->id)
                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->account_number }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('account_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Transaction Type Field -->
                <div class="form-group mb-3">
                    <label for="transaction_type" class="form-label">Transaction Type</label>
                    <select class="form-control @error('transaction_type') is-invalid @enderror" id="transaction_type" name="transaction_type" required>
                        <option value="" disabled selected>Select Transaction Type</option>
                        <option value="deposit" {{ old('transaction_type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                        <option value="withdraw" {{ old('transaction_type') == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                        <option value="transfer" {{ old('transaction_type') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                    @error('transaction_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Amount Field -->
                <div class="form-group mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" step="0.01" min="0" value="{{ old('amount') }}" required>
                    @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date Field -->
                <div class="form-group mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                    @error('date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Target Account Field for Transfers -->
                <div id="target_account_div" class="form-group {{ old('transaction_type') === 'transfer' ? '' : 'd-none' }}">
                    <label for="target_account_id" class="form-label">Target Account</label>
                    <select class="form-control @error('target_account_id') is-invalid @enderror" id="target_account_id" name="target_account_id">
                        <option value="" disabled selected>Select Target Account</option>
                        @foreach ($activeAccounts as $account)
                            <option value="{{ $account->id }}" {{ old('target_account_id') == $account->id ? 'selected' : '' }}>
                                {{ $account->account_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('target_account_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit Request</button>
                <a href="{{ route('Home') }}" class="btn btn-primary ml-2">Back</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    document.getElementById('transaction_type').addEventListener('change', function () {
        var targetAccountDiv = document.getElementById('target_account_div');
        if (this.value === 'transfer') {
            targetAccountDiv.classList.remove('d-none');
        } else {
            targetAccountDiv.classList.add('d-none');
        }
    });
    // document.getElementById('date').valueAsDate = new Date();
</script>
</body>
</html>

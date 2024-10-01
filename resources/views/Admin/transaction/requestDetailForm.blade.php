<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Request Details</title>
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

        .form-control[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Transaction Request Details</h4>
        </div>
        <div class="card-body">
            <div class="form-description">
                <h5 style="color: #007bff" class="font-weight-bold">Transaction Request Information</h5>
                <p>Below are the details of the transaction request you submitted. The data is read-only for your reference.</p>
            </div>

            <!-- Account Field -->
            <div class="form-group mb-3">
                <label for="account_id" class="form-label">Account Number</label>
                <input type="text" class="form-control" id="account_id" name="account_id" value="{{ $transaction->account->account_number ?? 'N/A' }}" readonly>
            </div>

            <!-- Account Type -->
            <div class="form-group mb-3">
                <label for="account_type" class="form-label">Account Type</label>
                <input type="text" class="form-control" id="account_type" name="account_type" value="{{ $transaction->account->account_type ?? 'N/A' }}" readonly>
            </div>

            <!-- Transaction Type -->
            <div class="form-group mb-3">
                <label for="transaction_type" class="form-label">Transaction Type</label>
                <input type="text" class="form-control" id="transaction_type" name="transaction_type" value="{{ $transaction->transaction_type ?? 'N/A' }}" readonly>
            </div>

            <!-- Amount -->
            <div class="form-group mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ number_format($transaction->amount ?? 0, 2) }}" readonly>
            </div>

            <!-- Date -->
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $transaction->date ?? '' }}" readonly>
            </div>

            <!-- Target Account (Only for Transfers) -->
            {{--            @if($transaction->transaction_type === 'transfer')--}}
            {{--                <div class="form-group mb-3">--}}
            {{--                    <label for="target_account_id" class="form-label">Target Account Number</label>--}}
            {{--                    <input type="text" class="form-control" id="target_account_id" name="target_account_id" value="{{ $transaction->target_account->account_number ?? 'N/A' }}" readonly>--}}
            {{--                </div>--}}

            {{--                <div class="form-group mb-3">--}}
            {{--                    <label for="target_account_type" class="form-label">Target Account Type</label>--}}
            {{--                    <input type="text" class="form-control" id="target_account_type" name="target_account_type" value="{{ $transaction->target_account->account_type ?? 'N/A' }}" readonly>--}}
            {{--                </div>--}}
            {{--            @endif--}}

            <div class="d-flex justify-content-lg-start">
                <form action="{{ route('transactions.accept', $transaction->id) }}" method="POST" style="display:inline;" onsubmit="return confirmAccept()">
                    @csrf
                    <button type="submit" class="btn btn-success" style="margin-right: 10px;">Accept</button>
                </form>
                <form action="{{ route('transactions.reject', $transaction->id) }}" method="POST" style="display:inline;" onsubmit="return confirmReject()">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function confirmAccept() {
        return confirm('Are you sure you want to accept this transaction?');
    }

    function confirmReject() {
        return confirm('Are you sure you want to reject this transaction?');
    }
</script>
</body>

</html>

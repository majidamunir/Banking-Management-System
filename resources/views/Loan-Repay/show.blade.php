<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repayment Details</title>
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
            border-color: #004494;
        }
        .container {
            max-width: 800px;
        }
        .btn-back {
            margin-top: 1rem;
        }
        .form-group label {
            font-weight: bold;
        }
        .alert {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    @if(Auth::check())
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Repayment Details</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="loan_id">Loan ID:</label>
                    <p id="loan_id">{{ $loanRepayment->loan_id }}</p>
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <p id="amount">${{ number_format($loanRepayment->amount, 2) }}</p>
                </div>
                <div class="form-group">
                    <label for="repayment_date">Repayment Date:</label>
                    <p id="repayment_date">{{ $loanRepayment->repayment_date }}</p>
                </div>
                <div class="text-left">
                    <a href="{{ route('loan-repayments.index') }}" class="btn btn-primary btn-back">Back</a>
                </div>
            </div>
        </div>
    @else
        <p>You do not have permission to access this page.</p>
    @endif
</div>
</body>
</html>

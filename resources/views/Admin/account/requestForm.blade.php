<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a New Account</title>
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
            background-color: #0056b3 !important;
            border-color: #004085 !important;
        }
        .btn-secondary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
        .btn-secondary:hover,
        .btn-secondary:active,
        .btn-secondary:focus,
        .btn-secondary:visited {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
        .form-description {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Request a New Account</h4>
        </div>
        <div class="card-body">
            <div class="form-description">
                <h5 style="color: #007bff" class="font-weight-bold">Purpose of this Form</h5>
                <p>This form allows customers to request the creation of a new account. Please select the account type and specify the initial deposit amount. Your request will be reviewed and processed by the admin.</p>
            </div>

            <form action="{{ route('customer.request-account') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group mb-3">
                    <label for="account_type" class="form-label">Account Type:</label>
                    <select class="form-control" id="account_type" name="account_type" required aria-required="true">
                        <option value="" disabled selected>Select Account Type</option>
                        <option value="savings">Savings</option>
                        <option value="checking">Checking</option>
                    </select>
                    @error('account_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="deposit_balance" class="form-label">Deposit Balance:</label>
                    <input type="number" name="deposit_balance" id="deposit_balance" class="form-control" required min="50" placeholder="Enter the Deposit Amount" aria-required="true">
                    @error('deposit_balance')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-lg-start">
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                    <a href="{{ route('Home') }}" class="btn btn-secondary ml-2">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

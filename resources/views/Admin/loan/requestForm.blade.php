<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Loan</title>
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
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Request a Loan</h4>
        </div>
        <div class="card-body">
            <div class="form-description">
                <h5 style="color: #007bff" class="font-weight-bold">Purpose of this Form</h5>
                <p>This form allows customers to submit a request for a loan. Please provide the loan details including the amount, interest rate, start date, and end date. Once submitted, the request will be reviewed and processed accordingly.</p>
            </div>

            <form action="{{ route('loan.request') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                    @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="interest_rate" class="form-label">Interest Rate (%):</label>
                    <input type="number" step="0.01" class="form-control" id="interest_rate" name="interest_rate" value="{{ old('interest_rate') }}">
                    @error('interest_rate')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                    @error('end_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-lg-start">
                    <button type="submit" class="btn btn-primary">Submit Loan Request</button>
                    <a href="{{ route('Home') }}" class="btn btn-success ml-2">Back</a>
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

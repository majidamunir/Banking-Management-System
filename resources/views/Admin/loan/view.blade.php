<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-primary, .btn-success, .btn-danger {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
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
                <h4 class="card-title mb-0">Loan Details</h4>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="user">User Name:</label>
                    <p id="user">{{ $loan->user->name }}</p>
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <p id="amount">{{ $loan->amount }}</p>
                </div>

                <div class="form-group">
                    <label for="interest_rate">Interest Rate (%):</label>
                    <p id="interest_rate">{{ $loan->interest_rate }}</p>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <p id="start_date">{{ $loan->start_date }}</p>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <p id="end_date">{{ $loan->end_date }}</p>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <p id="status">{{ ucfirst($loan->status) }}</p>
                </div>

                @if($loan->status === 'pending')
                    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

{{--                        <button type="submit" name="status" value="approved" class="btn btn-success">Approve</button>--}}
{{--                        <button type="submit" name="status" value="denied" class="btn btn-danger">Reject</button>--}}
                    </form>
                @elseif($loan->status === 'approved')
                    <div class="alert alert-success">
                        <strong>Congratulations!</strong> Your loan has been Approved.
                    </div>
                @elseif($loan->status === 'rejected')
                    <div class="alert alert-danger">
                        <strong>Sorry!</strong> Your loan has been Rejected.
                    </div>
                @endif

                <a href="{{ route('loans.index') }}" class="btn btn-primary btn-back">Back</a>
            </div>
        </div>
    @else
        <p>You do not have permission to access this page.</p>
    @endif
</div>
</body>
</html>

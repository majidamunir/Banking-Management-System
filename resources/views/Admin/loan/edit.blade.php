<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Loan Status</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }
        .container {
            max-width: 600px;
        }
        .btn-submit {
            display: inline-block;
            margin-top: 1rem;
            font-size: 1rem;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Update Loan Status</h4>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <form id="loan-form" action="{{ route('loans.update', $loan->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="status">Confirm Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="approved" {{ $loan->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $loan->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="pending" {{ $loan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="button" onclick="confirmUpdate()" class="btn btn-primary btn-submit">Update Status</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary btn-submit">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    function confirmUpdate() {
        const status = document.getElementById('status').value;
        if (confirm(`Are you sure you want to ${status} this loan?`)) {
            document.getElementById('loan-form').submit();
        }
    }
</script>
</body>

</html>

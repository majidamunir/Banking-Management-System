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

        .card-body .btn {
            margin-top: 1rem;
            font-size: 1.1rem;
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
            <!-- Displaying account details -->
            <div class="form-group mb-3">
                <label for="account_type" class="form-label"><strong>Account Type:</strong></label>
                <input type="text" class="form-control" id="account_type" value="{{ $account->account_type }}"
                       readonly>
            </div>

            <div class="form-group mb-3">
                <label for="balance" class="form-label">Balance:</label>
                <input type="text" class="form-control" id="balance" value="{{ $account->balance }}" readonly>
            </div>

            <div class="d-flex justify-content-start">
                <!-- Active button -->
                <form action="{{ route('accounts.activate', $account->id) }}" method="POST"
                      style="display:inline;" onsubmit="return confirmActivate();">
                    @csrf
                    <button type="submit" class="btn btn-primary">Active</button>
                </form>

                <!-- Add spacing between the buttons -->
                <div class="ml-2"></div>

                <!-- Inactive button -->
                <form action="{{ route('accounts.deactivate', $account->id) }}" method="POST"
                      style="display:inline;" onsubmit="return confirmDeactivate();">
                    @csrf
                    <button type="submit" class="btn btn-success">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Confirmation JavaScript -->
<script>
    function confirmActivate() {
        return confirm('Are you sure you want to activate this account?');
    }

    function confirmDeactivate() {
        return confirm('Are you sure you want to reject this account?');
    }
</script>
</body>

</html>

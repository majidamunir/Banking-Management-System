<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
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
            <h4 class="card-title mb-0">Update Account</h4>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <form id="account-form" action="{{ route('accounts.update', $account->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="balance">Balance:</label>
                    <input type="number" name="balance" id="balance" class="form-control"
                           value="{{ $account->balance }}" required>
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="status">Status:</label>--}}
{{--                    <select name="status" id="status" class="form-control" required>--}}
{{--                        <option value="active" {{ $account->status === 'active' ? 'selected' : '' }}>Active</option>--}}
{{--                        <option value="reject" {{ $account->status === 'reject' ? 'selected' : '' }}>Reject</option>--}}
{{--                        --}}{{--                        <option value="closed" {{ $account->status === 'closed' ? 'selected' : '' }}>Closed</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="form-group">
                    <button type="button" onclick="confirmUpdate()" class="btn btn-primary btn-submit">Update Account</button>
                    <a href="{{ route('accounts.index') }}" class="btn btn-primary btn-submit">Back</a>
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
        if (confirm('Are you sure you want to update this account?')) {
            document.getElementById('account-form').submit();
        }
    }
</script>
</body>

</html>

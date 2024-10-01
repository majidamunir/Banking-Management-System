{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Loan Request</title>--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        .card-header {--}}
{{--            background-color: #007bff;--}}
{{--            color: #ffffff;--}}
{{--        }--}}
{{--        .container {--}}
{{--            max-width: 600px;--}}
{{--        }--}}
{{--        .card-body .btn {--}}
{{--            margin-top: 1rem;--}}
{{--            font-size: 1.1rem;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container mt-4">--}}
{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title mb-0">Loan Request Details</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div class="form-group mb-3">--}}
{{--                <label for="amount" class="form-label">Amount:</label>--}}
{{--                <input type="text" class="form-control" id="amount" value="{{ $loan->amount }}" readonly>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="interest_rate" class="form-label">Interest Rate (%):</label>--}}
{{--                <input type="text" class="form-control" id="interest_rate" value="{{ $loan->interest_rate }}" readonly>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="start_date" class="form-label">Start Date:</label>--}}
{{--                <input type="text" class="form-control" id="start_date" value="{{ $loan->start_date }}" readonly>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="end_date" class="form-label">End Date:</label>--}}
{{--                <input type="text" class="form-control" id="end_date" value="{{ $loan->end_date }}" readonly>--}}
{{--            </div>--}}

{{--            <a href="#" id="approveBtn" class="btn btn-success" data-action="approved" data-toggle="modal" data-target="#confirmModal">Approve</a>--}}
{{--            <a href="#" id="rejectBtn" class="btn btn-danger ml-2" data-action="rejected" data-toggle="modal" data-target="#confirmModal">Reject</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- Bootstrap Modals -->--}}
{{--<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                Are you sure you want to <span id="actionType"></span> this loan?--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>--}}
{{--                <button type="button" id="confirmBtn" class="btn btn-success">Confirm</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- Form Template -->--}}
{{--<form id="loanForm" action="{{ route('loans.update', $loan->id) }}" method="POST" style="display: none;">--}}
{{--    @csrf--}}
{{--    @method('PATCH')--}}
{{--    <input type="hidden" name="status" id="loanStatus">--}}
{{--</form>--}}

{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#confirmModal').on('show.bs.modal', function (event) {--}}
{{--            var button = $(event.relatedTarget);--}}
{{--            var action = button.data('action');--}}
{{--            var modal = $(this);--}}
{{--            modal.find('#actionType').text(action);--}}
{{--            $('#loanStatus').val(action);--}}
{{--        });--}}

{{--        $('#confirmBtn').on('click', function() {--}}
{{--            $('#loanForm').submit();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Request</title>
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
            <h4 class="card-title mb-0">Loan Request Details</h4>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="text" class="form-control" id="amount" value="{{ $loan->amount }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="interest_rate" class="form-label">Interest Rate (%):</label>
                <input type="text" class="form-control" id="interest_rate" value="{{ $loan->interest_rate }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="text" class="form-control" id="start_date" value="{{ $loan->start_date }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="text" class="form-control" id="end_date" value="{{ $loan->end_date }}" readonly>
            </div>

            @if($loan->status === 'pending')
                <div class="form-group mb-3">
                    <label for="bank_account" class="form-label">Select Bank Account:</label>
                    <select class="form-control" id="bank_account" name="bank_account_id">
                        <option value="">-- Select a Bank Account --</option>
                        @foreach($bankAccounts as $account)
                            <option value="{{ $account->id }}">{{ $account->account_name }} (Balance: ${{ number_format($account->balance, 2) }})</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <a href="#" id="approveBtn" class="btn btn-success" data-action="approved" data-toggle="modal" data-target="#confirmModal">Approve</a>
            <a href="#" id="rejectBtn" class="btn btn-danger ml-2" data-action="rejected" data-toggle="modal" data-target="#confirmModal">Reject</a>
        </div>
    </div>
</div>

<!-- Bootstrap Modals -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to <span id="actionType"></span> this loan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmBtn" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Form Template -->
<form id="loanForm" action="{{ route('loans.update', $loan->id) }}" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="status" id="loanStatus">
    <input type="hidden" name="bank_account_id" id="bankAccountId"> <!-- Hidden input for bank account ID -->
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var modal = $(this);
            modal.find('#actionType').text(action);
            $('#loanStatus').val(action);
            $('#bankAccountId').val($('#bank_account').val());
        });

        $('#confirmBtn').on('click', function() {
            $('#loanForm').submit();
        });
    });
</script>
</body>
</html>


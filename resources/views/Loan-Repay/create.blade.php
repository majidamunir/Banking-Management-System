<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Repayments</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004494;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Loan Repayments</h1>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createRepaymentModal">Create Loan Repayment</button>

    <!-- Modal for Creating Repayment -->
    <div class="modal fade" id="createRepaymentModal" tabindex="-1" role="dialog" aria-labelledby="createRepaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRepaymentModalLabel">Create Loan Repayment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('loan-repayments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="loan_id">Loan:</label>
                            <select class="form-control" id="loan_id" name="loan_id" required>
                                @foreach($loans as $loan)
                                    @if($loan->amount > 0) <!-- Only show loans that are not fully repaid -->
                                    <option
                                        value="{{ $loan->id }}"
                                        data-interest-rate="{{ $loan->interest_rate }}"
                                        data-due-date="{{ $loan->end_date }}"
                                        data-loan-amount="{{ $loan->amount }}"
                                    >
                                        {{ $loan->id }} - ${{ number_format($loan->amount, 2) }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="repayment_date">Repayment Date:</label>
                            <input type="date" class="form-control" id="repayment_date" name="repayment_date" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_id">Bank Account:</label>
                            <input type="text" class="form-control" id="bank_account_id_display" value="{{ $bankAccount->account_name }}" readonly>
                            <input type="hidden" id="bank_account_id" name="bank_account_id" value="{{ $bankAccount->id }}">
                        </div>
                        <div id="interest-rate-info" class="d-none">
                            <h5>Interest Rate Information</h5>
                            <p>The loan has an interest rate of <span id="interest-rate-value"></span>%.</p>
                            <p>The additional interest amount is: $<span id="interest-amount"></span></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loanSelect = document.getElementById('loan_id');
        const repaymentDateInput = document.getElementById('repayment_date');
        const interestRateInfo = document.getElementById('interest-rate-info');
        const interestRateValue = document.getElementById('interest-rate-value');
        const interestAmountValue = document.getElementById('interest-amount');

        function checkInterestRate() {
            const selectedOption = loanSelect.options[loanSelect.selectedIndex];
            const interestRate = parseFloat(selectedOption.getAttribute('data-interest-rate'));
            const dueDate = new Date(selectedOption.getAttribute('data-due-date'));
            const repaymentDate = new Date(repaymentDateInput.value);
            const loanAmount = parseFloat(selectedOption.getAttribute('data-loan-amount'));
            const repaymentAmount = parseFloat(document.getElementById('amount').value) || 0;

            if (repaymentDate > dueDate) {
                // Repayment is late
                const additionalInterest = loanAmount * (interestRate / 100);
                const totalAmountDue = loanAmount + additionalInterest;
                const extraAmountNeeded = totalAmountDue - repaymentAmount;

                interestRateValue.textContent = interestRate.toFixed(2);
                interestAmountValue.textContent = extraAmountNeeded.toFixed(2);
                interestRateInfo.classList.remove('d-none');
            } else {
                // Repayment is on time
                interestRateInfo.classList.add('d-none');
            }
        }

        loanSelect.addEventListener('change', checkInterestRate);
        repaymentDateInput.addEventListener('change', checkInterestRate);
        document.getElementById('amount').addEventListener('input', checkInterestRate);
    });
</script>
</body>
</html>

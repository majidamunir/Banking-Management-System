<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Loan Repayments</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .card-body {
            padding: 1.5rem;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table .thead-blue th {
            background-color: #007bff;
            color: #fff;
        }
        .btn {
            margin-right: 5px;
        }
        .container {
            max-width: 1200px;
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
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pusher = new Pusher('25b0be301eb41dc23b11', {
                cluster: 'ap3'
            });

            const accountChannel = pusher.subscribe('accountChannel');
            const transactionChannel = pusher.subscribe('transactionChannel');
            const loanChannel = pusher.subscribe('loanChannel');

            // Load notifications on page load
            loadNotifications();

            function loadNotifications() {
                fetch('/notifications/unread')
                    .then(response => response.json())
                    .then(data => {
                        console.log('Loaded Notifications:', data);

                        const notificationList = document.getElementById('notification-list');
                        notificationList.innerHTML = ''; // Clear existing notifications

                        const notificationCountElem = document.getElementById('notification-count');
                        notificationCountElem.textContent = data.length;
                        notificationCountElem.style.display = data.length > 0 ? 'inline-block' : 'none';

                        data.forEach(notification => {
                            addNotificationToDropdown(notification);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching notifications:', error);
                    });
            }

            function storeNotification(type, data) {
                fetch('/notifications', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ type, data })
                })
                    .then(response => response.json())
                    .then(() => {
                        loadNotifications(); // Reload notifications after storing
                    })
                    .catch(error => {
                        console.error('Error storing notification:', error);
                    });
            }

            function markAsRead(notificationId, notificationItem) {
                fetch(`/notifications/${notificationId}/read`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                    .then(() => {
                        notificationItem.remove();
                        loadNotifications(); // Reload notifications to update count
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                    });
            }

            function addNotificationToDropdown(notification) {
                const notificationList = document.getElementById('notification-list');
                const notificationItem = document.createElement('div');
                notificationItem.className = 'dropdown-item d-flex justify-content-between align-items-center';
                notificationItem.style.borderBottom = '1px solid #e9ecef';
                notificationItem.style.padding = '7px';
                notificationItem.style.backgroundColor = '#ffffff';

                const data = typeof notification.data === 'string' ? JSON.parse(notification.data) : notification.data;

                const messageSpan = document.createElement('span');
                messageSpan.textContent = data.message || 'No message available';

                const viewButton = document.createElement('a');
                viewButton.href = data.view_url || '#';
                viewButton.className = 'btn btn-sm btn-primary';
                viewButton.textContent = 'View';
                viewButton.style.marginLeft = '10px';

                viewButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    markAsRead(notification.id, notificationItem);
                    setTimeout(() => {
                        window.location.href = viewButton.href;
                    }, 100);
                });

                notificationItem.appendChild(messageSpan);
                notificationItem.appendChild(viewButton);

                notificationList.appendChild(notificationItem);
            }

            accountChannel.bind('account-creation-requested', function (data) {
                storeNotification('account-creation-requested', {
                    message: `${data.request.user_name || 'Unknown User'} has requested to create an account!`,
                    view_url: `/account/${data.request.account_number}`
                });
            });

            transactionChannel.bind('transaction-requested', function (data) {
                const userName = data.request?.user_name || 'Unknown User';
                const requestId = data.request?.id || 'Unknown ID';

                storeNotification('transaction-requested', {
                    message: `${userName} has requested to create a transaction!`,
                    view_url: `/transaction/details/${requestId}`
                });
            });

            loanChannel.bind('loan-requested', function (data) {
                const userName = data.user_name || 'Unknown User';
                const loanAmount = data.loan?.amount || 'Unknown Amount';
                const loanId = data.loan?.id || 'Unknown ID';

                storeNotification('loan-requested', {
                    message: `${userName} has requested a loan of $${loanAmount}!`,
                    view_url: `/loan/${loanId}`
                });
            });
        });
    </script>
</head>
<body>
<div class="container mt-4">
    <div class="heading-container mb-4">
        <h2>Loan Repayments</h2>
    </div>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createRepaymentModal">Add New Repayment</button>

    <!-- Table of Repayments -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title mb-0">Repayments Table</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-blue">
                <tr>
                    <th>ID</th>
                    <th>Loan ID</th>
                    <th>Amount</th>
                    <th>Interest Rate</th>
                    <th>Repayment Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($repayments as $repayment)
                    <tr>
                        <td>{{ $repayment->id }}</td>
                        <td>{{ $repayment->loan->id }}</td>
                        <td>${{ number_format($repayment->amount, 2) }}</td>
                        <td>${{ number_format($repayment->interest_rate, 2) }}</td>
                        <td>{{ $repayment->repayment_date }}</td>
                        <td>{{ ucfirst($repayment->status) }}</td>
                        <td>
                            <a href="{{ route('loan-repayments.show', $repayment->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No repayments found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('loans.index') }}" class="btn btn-primary">Back</a>
</div>

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
                const additionalInterest = loanAmount * (interestRate / 100);
                const totalAmountDue = loanAmount + additionalInterest;
                const extraAmountNeeded = totalAmountDue - repaymentAmount;

                interestRateValue.textContent = interestRate.toFixed(2);
                interestAmountValue.textContent = extraAmountNeeded.toFixed(2);
                interestRateInfo.classList.remove('d-none');
            } else {
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

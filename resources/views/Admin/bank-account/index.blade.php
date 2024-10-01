<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bank Accounts</title>
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
        .user-info-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: default;
            display: inline-block;
            margin-left: 15px;
        }
        .heading-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
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
    <div class="heading-container">
        <h2>Bank Accounts</h2>
    </div>

    <!-- Table of Accounts -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title mb-0">Accounts Table</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-blue">
                <tr>
{{--                    <th>ID</th>--}}
                    <th>Account Name</th>
                    <th>Balance</th>
                    <th>Interest Rate (%)</th>
                    <th>Disbursed Amount</th>
                    <th>Returned Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bankAccounts as $account)
                    <tr>
{{--                        <td>{{ $account->id }}</td>--}}
                        <td>{{ $account->account_name }}</td>
                        <td>${{ number_format($account->balance, 2) }}</td>
                        <td>{{ $account->interest_rate ? number_format($account->interest_rate, 2) : 'N/A' }}</td>
                        <td>${{ number_format($account->disbursed_amount, 2) }}</td> <!-- Disbursed Amount -->
                        <td>${{ number_format($account->returned_amount, 2) }}</td> <!-- Returned Amount -->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('Dashboard') }}" class="btn btn-primary">Back</a>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

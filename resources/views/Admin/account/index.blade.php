<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accounts Index</title>
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
        .table .thead-dark th, .table .thead-blue th {
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
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
    <script>
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this account?')) {
                event.preventDefault();
            }
        }
    </script>
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
    @if(Auth::check())
        <div class="heading-container">
            <h2>Accounts Details</h2>
            <button class="user-info-btn">Welcome {{ Auth::user()->name }}</button>
        </div>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display Error Message -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Accounts Table</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="{{ Auth::user()->role === 'admin' ? 'thead-dark' : 'thead-blue' }}">
                    <tr>
                        <th>ID</th>
                        @if(Auth::user()->role === 'admin')
                            <th>Customer</th>
                        @endif
                        <th>Account Type</th>
                        <th>Balance</th>
                        <th>Status</th> <!-- Added Status Column -->
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            @if(Auth::user()->role === 'admin')
                                <td>{{ $account->user->name }}</td>
                            @endif
                            <td>{{ ucfirst($account->account_type) }}</td>
                            <td>${{ number_format($account->balance, 2) }}</td>
                            <td>{{ ucfirst($account->status) }}</td> <!-- Display Status -->
                            <td>
                                <a href="{{ route('accounts.show', $account->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-success btn-sm">Edit</a>
                            @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ Auth::user()->role === 'admin' ? route('Dashboard') : route('Home') }}" class="btn btn-primary">Back</a>
    @else
        <p>You need to be logged in to view accounts.</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

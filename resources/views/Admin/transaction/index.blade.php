<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transactions List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #dee2e6;
            color: black;
        }
        .card-body {
            padding: 1.5rem;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table .thead-dark th {
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
        .search-bar {
            max-width: 300px;
        }
        .search-bar .input-group {
            width: 100%;
        }
        .search-bar input {
            font-size: 1rem;
            height: calc(1.8em + 0.75rem + 2px);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                let searchQuery = $(this).val();
                $.ajax({
                    url: $('#search-form').attr('action'),
                    type: $('#search-form').attr('method'),
                    data: { search: searchQuery },
                    success: function(data) {
                        $('#transactions-table tbody').html(data);
                    }
                });
            });
        });

        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this transaction?')) {
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
    <div class="heading-container">
        <h2 style="color: black">Transactions History</h2>
        <div class="d-flex align-items-center">
            <button class="user-info-btn">Welcome {{ Auth::user()->name }}</button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-4">
{{--        @if(Auth::user()->role === 'admin')--}}
{{--            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-custom">Create New Transaction</a>--}}
{{--        @endif--}}

        <!-- Search Bar -->
        <div class="search-bar">
            <form id="search-form" method="GET" action="{{ route('transactions.index') }}">
                <div class="input-group">
                    <input type="text" id="search-input" name="search" class="form-control" placeholder="Search Transactions" value="{{ request()->get('search') }}">
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title mb-0">Transactions Table</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="transactions-table">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Account ID</th>
                    <th>Type</th>
                    <th>Amount</th>
{{--                    <th>Date</th>--}}
                    <th>Status</th>
{{--                    @if(Auth::user()->role === 'customer')--}}
{{--                        <th>PDF</th>--}}
{{--                    @endif--}}
                    @if(Auth::user()->role === 'admin')
                        <th>Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->account_id }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
{{--                        <td>{{ $transaction->date }}</td>--}}
                        <td>{{ ucfirst($transaction->status) }}</td>
{{--                        @if(Auth::user()->role === 'customer')--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('transactions.downloadPDF', $transaction->id) }}" class="btn btn-success btn-sm">PDF</a>--}}
{{--                            </td>--}}
{{--                        @endif--}}
                        @if(Auth::user()->role === 'admin')
                            <td>
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">View</a>
{{--                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-success btn-sm">Edit</a>--}}
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if(Auth::user()->role === 'customer')
        <a href="{{ route('test') }}" class="btn btn-success">Download All Transactions</a>
    @endif
    <a href="{{ Auth::user()->role === 'admin' ? route('Dashboard') : route('Home') }}" class="btn btn-primary">Back</a>
</div>
</body>
</html>

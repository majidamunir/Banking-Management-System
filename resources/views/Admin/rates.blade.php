<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Exchange Rates Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

    <style>
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
        }

        thead {
            color: white;
            background-color: #007bff;
        }

        tbody {
            background-color: white;
            color: black;
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
<div class="container">
    <h1 class="mt-4">Exchange Rates</h1>

    <div class="btn-group mt-4" role="group">
        <button id="todayButton" class="btn btn-primary">Today's Rate</button>
        <button id="monthButton" class="btn btn-secondary">Past Month's Rate</button>
    </div>

    <div class="chart-container mt-4">
        <canvas id="exchangeRatesChart"></canvas>
    </div>

    <table class="table table-bordered mt-5">
        <thead>
        <tr>
            <th>Date</th>
            <th>Currency From</th>
            <th>Currency To</th>
            <th>Rate</th>
        </tr>
        </thead>
        <tbody id="ratesTableBody">
        @foreach ($dailyData as $date => $rates)
            @foreach ($rates as $currency => $rate)
                <tr class="data-row" data-date="{{ $date }}" data-currency="{{ $currency }}">
                    <td>{{ $date }}</td>
                    <td>EUR</td>
                    <td>{{ $currency }}</td>
                    <td>{{ $rate }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('exchangeRatesChart').getContext('2d');
            const dailyData = @json($dailyData);
            const currencies = @json($currencies);

            let chart;

            function createChart(labels, data, chartType, chartTitle) {
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: labels,
                        datasets: currencies.map(currency => ({
                            label: currency,
                            data: labels.map(date => data[date]?.[currency] ?? 0),
                            borderColor: getRandomColor(),
                            backgroundColor: chartType === 'bar' ? getRandomColor() : 'rgba(0, 123, 255, 0.1)',
                            borderWidth: 2,
                            tension: chartType === 'line' ? 0.3 : 0,
                            fill: chartType === 'line' ? true : false,
                            barPercentage: 0.9,
                            categoryPercentage: 0.8,
                        }))
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: chartTitle
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            },
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                },
                                type: chartType === 'line' ? 'time' : 'category',
                                time: {
                                    unit: 'day'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Rate'
                                },
                                beginAtZero: false,
                            }
                        }
                    }
                });
            }

            function getChartDataForToday() {
                const today = new Date().toISOString().split('T')[0];
                createChart([today], { [today]: dailyData[today] || {} }, 'bar', 'Exchange Rates - Today');
                updateTable(today);
            }

            function getChartDataForMonth() {
                const labels = Object.keys(dailyData).sort();
                createChart(labels, dailyData, 'line', 'Exchange Rates - Past Month');
                updateTable();
            }

            function updateTable(selectedDate = null) {
                const rows = document.querySelectorAll('.data-row');
                rows.forEach(row => {
                    const rowDate = row.getAttribute('data-date');
                    if (selectedDate === null || rowDate === selectedDate) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            document.getElementById('todayButton').addEventListener('click', () => {
                getChartDataForToday();
            });

            document.getElementById('monthButton').addEventListener('click', () => {
                getChartDataForMonth();
            });

            getChartDataForMonth();
        });

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    <a href="{{ Auth::user()->role === 'admin' ? route('Dashboard') : route('Home') }}" class="btn btn-primary">Back</a>
</div>
</body>
</html>

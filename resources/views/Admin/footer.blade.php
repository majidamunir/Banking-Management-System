<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li><a href="https://www.creative-tim.com" target="_blank">Banking System</a></li>
                    <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                    <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
                </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Banking System
              </span>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        demo.initChartsPages();
    });
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

        // Bind Pusher events
        accountChannel.bind('account-creation-requested', function (data) {
            storeNotification('account-creation-requested', {
                message: `${data.request.user_name || 'Unknown User'} has requested to create an account!`,
                view_url: `/account/${data.request.account_number}`
            });
        });

        transactionChannel.bind('transaction-requested', function (data) {
            storeNotification('transaction-requested', {
                message: `${data.request?.user_name || 'Unknown User'} has requested to create a transaction!`,
                view_url: `/transaction/details/${data.request?.id || 'Unknown ID'}`
            });
        });

        loanChannel.bind('loan-requested', function (data) {
            storeNotification('loan-requested', {
                message: `${data.user_name || 'Unknown User'} has requested a loan of $${data.loan?.amount || 'Unknown Amount'}!`,
                view_url: `/loan/${data.loan?.id || 'Unknown ID'}`
            });
        });
    });
</script>


{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const pusher = new Pusher('25b0be301eb41dc23b11', {--}}
{{--            cluster: 'ap3'--}}
{{--        });--}}

{{--        const accountChannel = pusher.subscribe('accountChannel');--}}
{{--        const transactionChannel = pusher.subscribe('transactionChannel');--}}
{{--        const loanChannel = pusher.subscribe('loanChannel');--}}

{{--        // Load notifications on page load--}}
{{--        loadNotifications();--}}

{{--        function loadNotifications() {--}}
{{--            fetch('/notifications/unread')--}}
{{--                .then(response => response.json()) // Parse response as JSON directly--}}
{{--                .then(data => {--}}
{{--                    console.log('Loaded Notifications:', data);--}}

{{--                    const notificationList = document.getElementById('notification-list');--}}
{{--                    notificationList.innerHTML = ''; // Clear existing notifications--}}

{{--                    const notificationCountElem = document.getElementById('notification-count');--}}
{{--                    notificationCountElem.textContent = data.length;--}}

{{--                    notificationCountElem.style.display = data.length > 0 ? 'inline-block' : 'none';--}}

{{--                    data.forEach(notification => {--}}
{{--                        addNotificationToDropdown(notification);--}}
{{--                    });--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.error('Error fetching notifications:', error);--}}
{{--                });--}}
{{--        }--}}

{{--        function storeNotification(type, data) {--}}
{{--            fetch('/notifications', {--}}
{{--                method: 'POST',--}}
{{--                headers: {--}}
{{--                    'Content-Type': 'application/json',--}}
{{--                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),--}}
{{--                },--}}
{{--                body: JSON.stringify({ type, data }) // Convert data to JSON if not already--}}
{{--            })--}}
{{--                .then(response => response.json())--}}
{{--                .then(() => {--}}
{{--                    loadNotifications(); // Reload notifications after storing--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.error('Error storing notification:', error);--}}
{{--                });--}}
{{--        }--}}

{{--        function markAsRead(notificationId, notificationItem) {--}}
{{--            fetch(`/notifications/${notificationId}/read`, {--}}
{{--                method: 'PATCH',--}}
{{--                headers: {--}}
{{--                    'Content-Type': 'application/json',--}}
{{--                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),--}}
{{--                }--}}
{{--            })--}}
{{--                .then(() => {--}}
{{--                    notificationItem.remove();--}}
{{--                    loadNotifications(); // Reload notifications to update count--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.error('Error marking notification as read:', error);--}}
{{--                });--}}
{{--        }--}}

{{--        function addNotificationToDropdown(notification) {--}}
{{--            const notificationList = document.getElementById('notification-list');--}}
{{--            const notificationItem = document.createElement('div');--}}
{{--            notificationItem.className = 'dropdown-item d-flex justify-content-between align-items-center';--}}
{{--            notificationItem.style.borderBottom = '1px solid #e9ecef';--}}
{{--            notificationItem.style.padding = '7px';--}}
{{--            notificationItem.style.backgroundColor = '#ffffff';--}}

{{--            // Parse notification.data if it's a JSON string--}}
{{--            const data = typeof notification.data === 'string' ? JSON.parse(notification.data) : notification.data;--}}

{{--            const messageSpan = document.createElement('span');--}}
{{--            messageSpan.textContent = data.message || 'No message available';--}}

{{--            const viewButton = document.createElement('a');--}}
{{--            viewButton.href = data.view_url || '#';--}}
{{--            viewButton.className = 'btn btn-sm btn-primary';--}}
{{--            viewButton.textContent = 'View';--}}
{{--            viewButton.style.marginLeft = '10px';--}}

{{--            viewButton.addEventListener('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                markAsRead(notification.id, notificationItem);--}}
{{--                setTimeout(() => {--}}
{{--                    window.location.href = viewButton.href;--}}
{{--                }, 100);--}}
{{--            });--}}

{{--            notificationItem.appendChild(messageSpan);--}}
{{--            notificationItem.appendChild(viewButton);--}}

{{--            notificationList.appendChild(notificationItem);--}}
{{--        }--}}

{{--        // Bind Pusher events--}}
{{--        accountChannel.bind('account-creation-requested', function (data) {--}}
{{--            storeNotification('account-creation-requested', {--}}
{{--                message: `${data.request.user_name || 'Unknown User'} has requested to create an account!`,--}}
{{--                view_url: `/account/${data.request.account_number}`--}}
{{--            });--}}
{{--        });--}}

{{--        transactionChannel.bind('transaction-requested', function (data) {--}}
{{--            // Check the data structure--}}
{{--            console.log('Transaction Data:', data);--}}

{{--            // Validate data properties--}}
{{--            const userName = data.request?.user_name || 'Unknown User';--}}
{{--            const requestId = data.request?.id || 'Unknown ID';--}}

{{--            storeNotification('transaction-requested', {--}}
{{--                message: `${userName} has requested to create a transaction!`,--}}
{{--                view_url: `/transaction/details/${requestId}`--}}
{{--            });--}}
{{--        });--}}

{{--        loanChannel.bind('loan-requested', function (data) {--}}
{{--            // Check the data structure--}}
{{--            console.log('Loan Data:', data);--}}

{{--            // Validate data properties--}}
{{--            const userName = data.user_name || 'Unknown User';--}}
{{--            const loanAmount = data.loan?.amount || 'Unknown Amount';--}}
{{--            const loanId = data.loan?.id || 'Unknown ID';--}}

{{--            storeNotification('loan-requested', {--}}
{{--                message: `${userName} has requested a loan of $${loanAmount}!`,--}}
{{--                view_url: `/loan/${loanId}`--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{-- /// --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

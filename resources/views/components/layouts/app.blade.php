<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    @livewireStyles
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Dropdown container */
.notification-dropdown {
    background-color: #2d3748; /* Dark background */
    color: #fff; /* White text */
    border-radius: 0.5rem;
    padding: 1rem;
    max-width: 400px;
    max-height: 500px;
    overflow-y: auto; /* Scrollable if too many notifications */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

/* Individual notification items */
.notification-item {
    display: flex;
    align-items: center;
    background-color: #38a169; /* Green background for individual items */
    color: white;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, background-color 0.2s;
    cursor: pointer;
}

/* Hover effect */
.notification-item:hover {
    background-color: #2f855a; /* Darker green on hover */
    transform: translateY(-2px); /* Slight lift on hover */
}

/* Icon for notifications */
.notification-icon {
    font-size: 1.5rem;
    margin-right: 1rem;
}

/* Notification message text */
.notification-message {
    flex-grow: 1; /* Take up remaining space */
    font-size: 1rem;
}

/* Timestamp */
.notification-timestamp {
    font-size: 0.875rem;
    color: #cbd5e0; /* Light gray for timestamps */
}

/* Scrollbar styling for overflow */
.notification-dropdown::-webkit-scrollbar {
    width: 8px;
}

.notification-dropdown::-webkit-scrollbar-thumb {
    background-color: #4a5568; /* Dark gray */
    border-radius: 4px;
}

.notification-dropdown::-webkit-scrollbar-thumb:hover {
    background-color: #2d3748; /* Even darker gray */
}


    </style>

    <title>{{ $title ?? 'Page Title' }}</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable Pusher logging (remove in production)
        Pusher.logToConsole = true;

        // Initialize Pusher
        var pusher = new Pusher('a74b032d83a88ac72191', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('notification');

        channel.bind('test.notification', function(data) {
            console.log(data);
            Livewire.emit('TestNotification', data);
            // Display the notification alert (or update UI)
            // alert(JSON.stringify(data));
            // Optionally, update a notification count in the header, for example:
            // document.getElementById('notification-count').textContent = data.unreadCount;
        });
    </script>
</head>
<body>
    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        @include('partials.header')
    @endif

    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        {{ $slot }}
    </main>

    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        @include('partials.footer')
    @endif

    @livewireScripts

    <script>
        // Optional - Fetch notifications and handle updates for notification count (like in your commented code)
        document.addEventListener('DOMContentLoaded', function () {
            const notificationCountElement = document.getElementById('notification-count');
            const notificationsDropdown = document.getElementById('notifications-dropdown');
            const notificationIcon = document.getElementById('notification-icon');

            // Toggle dropdown visibility
            notificationIcon.addEventListener('click', function () {
                notificationsDropdown.classList.toggle('hidden');
            });

            function fetchNotifications() {
    fetch('{{ route('notifications.index') }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Update notification count
            notificationCountElement.textContent = data.unreadCount;

            // Clear and populate the dropdown with notifications
            notificationsDropdown.innerHTML = ''; // Clear existing notifications
            if (data.notifications && data.notifications.length > 0) {
                data.notifications.forEach(notification => {
                    const item = document.createElement('div');
                    item.className = 'notification-item';

                    // Add icon
                    const icon = document.createElement('span');
                    icon.className = 'notification-icon';
                    icon.innerHTML = '🔔'; // Replace with an actual icon or SVG if needed

                    // Add message
                    const message = document.createElement('div');
                    message.className = 'notification-message';
                    message.textContent = notification.data.message;

                    // Add timestamp
                    const timestamp = document.createElement('div');
                    timestamp.className = 'notification-timestamp';
                    timestamp.textContent = new Date(notification.created_at).toLocaleString();

                    item.appendChild(icon);
                    item.appendChild(message);
                    item.appendChild(timestamp);
                    notificationsDropdown.appendChild(item);
                });
            } else {
                const emptyMessage = document.createElement('div');
                emptyMessage.className = 'text-center text-gray-400 py-2';
                emptyMessage.textContent = 'No notifications';
                notificationsDropdown.appendChild(emptyMessage);
            }
        })
        .catch(error => console.error('Error fetching notifications:', error));
}


            // Fetch notifications on page load
            fetchNotifications();
            // Poll for updates every 30 seconds
            setInterval(fetchNotifications, 30000);
        });
    </script>
</body>
</html>

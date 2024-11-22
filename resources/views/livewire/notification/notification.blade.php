<div x-data="{ open: false }" class="relative">
    <!-- Button to Toggle Dropdown -->
    <button
        type="button"
        @click="open = !open"
        class="rounded-full relative bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
        <span class="sr-only">View notifications</span>
        <span id="notification-count" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2">
           0
        </span>
        <svg
            id="notification-icon"
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
    </button>

    <!-- Notification Button and Dropdown -->
    <div class="relative">

        <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-md w-64">
            <!-- Notifications will be dynamically added here -->
        </div>
    </div>


</div>

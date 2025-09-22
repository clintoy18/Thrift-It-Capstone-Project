<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">All Notifications</h3>
                        <button id="markAllRead" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Mark All as Read
                        </button>
                    </div>

                    <div id="notificationsContainer" class="space-y-4">
                        <!-- Notifications will be loaded here -->
                    </div>

                    <div id="loadingSpinner" class="text-center py-8">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                        <p class="mt-2 text-gray-500">Loading notifications...</p>
                    </div>

                    <div id="emptyState" class="text-center py-8 hidden">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 1 0-15 0v5h5l-5 5-5-5h5v-5a7.5 7.5 0 1 1 15 0v5z"></path>
                        </svg>
                        <p class="text-gray-500">No notifications yet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('notificationsContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const emptyState = document.getElementById('emptyState');
            const markAllReadBtn = document.getElementById('markAllRead');

            // Load notifications
            async function loadNotifications() {
                try {
                    const response = await fetch('/notifications');
                    const data = await response.json();
                    
                    loadingSpinner.style.display = 'none';
                    
                    if (data.notifications.length === 0) {
                        emptyState.style.display = 'block';
                        return;
                    }

                    container.innerHTML = data.notifications.map(notification => `
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer ${notification.read_at ? 'bg-gray-50' : 'bg-white'}"
                             onclick="markAsRead(${notification.id}); window.location.href = '/products/' + notification.data.product_id">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">
                                            ${notification.data.commenter_name} commented on your product
                                        </p>
                                        ${!notification.read_at ? '<div class="w-2 h-2 bg-blue-500 rounded-full"></div>' : ''}
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">${notification.data.product_title}</p>
                                    <p class="text-sm text-gray-500 mt-1">${notification.data.comment_preview}...</p>
                                    <p class="text-xs text-gray-400 mt-2">${new Date(notification.created_at).toLocaleString()}</p>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } catch (error) {
                    console.error('Error loading notifications:', error);
                    loadingSpinner.style.display = 'none';
                    container.innerHTML = '<p class="text-red-500 text-center">Error loading notifications</p>';
                }
            }

            // Mark notification as read
            async function markAsRead(notificationId) {
                try {
                    await fetch(`/notifications/${notificationId}/read`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });
                } catch (error) {
                    console.error('Error marking notification as read:', error);
                }
            }

            // Mark all as read
            async function markAllAsRead() {
                try {
                    await fetch('/notifications/mark-all-read', {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });
                    loadNotifications();
                } catch (error) {
                    console.error('Error marking all notifications as read:', error);
                }
            }

            // Event listeners
            markAllReadBtn.addEventListener('click', markAllAsRead);

            // Load notifications on page load
            loadNotifications();
        });
    </script>
    @endpush
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                Messages
            </h2>
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden h-[600px] flex flex-col md:flex-row">
                <!-- Conversations Sidebar -->
                <div
                    class="w-full md:w-80 bg-[#F4F2ED] dark:bg-gray-900 border-b md:border-b-0 md:border-r border-[#B59F84] dark:border-gray-700 flex flex-col">
                    <!-- Sidebar Header -->
                    <div class="p-4 border-b border-[#B59F84] dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-[#634600] dark:text-white">Messages</h2>
                        <div class="flex items-center gap-2">
                            <!-- Settings Dropdown -->
                            <div id="messages-settings-dropdown" class="relative">
                                <button id="messages-settings-toggle-btn" 
                                        class="p-2 text-[#786126] dark:text-white hover:text-[#634600] dark:hover:text-yellow-400 hover:bg-[#B59F84] hover:bg-opacity-20 rounded-full transition-colors relative">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="messages-settings-dropdown-menu"
                                     class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg z-[100] py-1">
                                    <!-- Blocked Users -->
                                    <button type="button" 
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center space-x-2"
                                            onclick="showBlockedUsers()">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        <span>Blocked Users</span>
                                    </button>
                                </div>
                            </div>
                            <button
                                class="md:hidden p-2 text-[#786126] dark:text-white hover:text-[#634600] hover:bg-[#B59F84] hover:bg-opacity-20 rounded-full transition-colors"
                                onclick="document.getElementById('sidebar').classList.toggle('hidden')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="p-4">
                        <div class="relative">
                            <input type="text" placeholder="Search conversations..."
                                class="w-full pl-10 pr-4 py-2 border border-[#B59F84] dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-transparent bg-white dark:bg-gray-800 text-sm dark:text-white placeholder-gray-500 dark:placeholder-text-white">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-[#786126] dark:text-white"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Conversations List -->
                    <div class="flex-1 overflow-y-auto" id="sidebar">
                        @if ($conversations->count() > 0)
                            @foreach ($conversations as $conversation)
                                <a href="{{ route('private.chat', $conversation['user']->id) }}"
                                    class="flex items-center p-4 hover:bg-[#B59F84] hover:bg-opacity-20 dark:hover:bg-yellow-800 transition-colors">
                                    <!-- Avatar -->
                                    <div class="relative">
                                    <img src="{{ $conversation['user']->profileImageUrl() }}" 
                                        alt="{{ $conversation['user']->fname }} {{ $conversation['user']->lname }}"
                                        class="w-12 h-12 rounded-full object-cover">
                                    </div>

                                    <!-- Conversation Info -->
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-[#634600] dark:text-white truncate">
                                                {{ $conversation['user']->fname }} {{ $conversation['user']->lname }}
                                            </p>
                                            <p class="text-xs text-[#786126] dark:text-white">
                                                {{ $conversation['latest_message']->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="text-sm text-[#786126] dark:text-white truncate">
                                            {{ $conversation['latest_message']->message }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-full p-4">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-[#B59F84] bg-opacity-30 dark:bg-[#f5d68b] rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-[#786126] dark:text-[#634600]" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-[#634600] dark:text-white text-sm">No conversations yet</p>
                                    <p class="text-[#786126] dark:text-white text-xs">Start chatting with someone!
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Welcome / Chat Area -->
                <div class="flex-1 flex items-center justify-center bg-[#F4F2ED] dark:bg-gray-800 p-4">
                    <div class="text-center">
                        <div
                            class="w-24 h-24 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#634600] dark:text-white mb-2">Welcome to Messages
                        </h3>
                        <p class="text-[#786126] dark:text-white mb-6">Select a conversation from the sidebar to
                            start chatting</p>
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <a href="{{ route('dashboard') }}"
                                class="px-4 py-2 bg-[#634600] dark:bg-yellow-600 text-white rounded-lg hover:bg-[#56432C] dark:hover:bg-yellow-500 transition-colors">
                                Browse Products
                            </a>
                            <a href="{{ route('products.index') }}"
                                class="px-4 py-2 border border-[#B59F84] dark:border-yellow-400 text-[#634600] dark:text-white rounded-lg hover:bg-[#B59F84] hover:bg-opacity-20 dark:hover:bg-yellow-700 transition-colors">
                                My Products
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Settings dropdown toggle
        document.addEventListener('DOMContentLoaded', function() {
            const settingsToggleBtn = document.getElementById('messages-settings-toggle-btn');
            const settingsDropdownMenu = document.getElementById('messages-settings-dropdown-menu');
            
            if (settingsToggleBtn && settingsDropdownMenu) {
                settingsToggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    settingsDropdownMenu.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!settingsToggleBtn.contains(e.target) && !settingsDropdownMenu.contains(e.target)) {
                        settingsDropdownMenu.classList.add('hidden');
                    }
                });
            }
        });

        // Notification function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-3 sm:p-4 rounded-lg shadow-lg z-50 text-sm sm:text-base ${
                type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function showBlockedUsers() {
            // Close dropdown
            const dropdownMenu = document.getElementById('messages-settings-dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('hidden');
            }
            
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Show loading state
            const modal = document.createElement('div');
            modal.id = 'blocked-users-modal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[200]';
            modal.innerHTML = `
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Blocked Users</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4">
                        <div class="text-center py-8">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#634600] mx-auto"></div>
                            <p class="text-gray-500 dark:text-gray-400 mt-4">Loading blocked users...</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Fetch blocked users
            fetch('/users/blocked', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch blocked users');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateBlockedUsersModal(data.blocked_users);
                } else {
                    throw new Error('Failed to load blocked users');
                }
            })
            .catch(error => {
                console.error('Error fetching blocked users:', error);
                modal.querySelector('.flex-1').innerHTML = `
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Failed to load blocked users. Please try again.</p>
                    </div>
                `;
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }
        
        function updateBlockedUsersModal(blockedUsers) {
            const modal = document.getElementById('blocked-users-modal');
            if (!modal) return;
            
            const contentDiv = modal.querySelector('.flex-1');
            
            if (blockedUsers.length === 0) {
                contentDiv.innerHTML = `
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">No blocked users</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">You haven't blocked any users yet.</p>
                    </div>
                `;
                return;
            }
            
            contentDiv.innerHTML = `
                <div class="space-y-3">
                    ${blockedUsers.map(user => `
                        <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center overflow-hidden bg-gradient-to-r from-[#634600] to-[#B59F84] flex-shrink-0">
                                    ${user.profile_pic_url 
                                        ? `<img src="${user.profile_pic_url}" alt="${user.fname} ${user.lname}" class="w-full h-full object-cover rounded-full">`
                                        : `<span class="text-white font-semibold text-sm">${user.fname.charAt(0)}${user.lname.charAt(0)}</span>`
                                    }
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">${user.fname} ${user.lname}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Blocked ${new Date(user.blocked_at).toLocaleDateString()}</p>
                                </div>
                            </div>
                            <button onclick="unblockUser(${user.id}, '${user.fname} ${user.lname}')" 
                                    class="ml-3 px-4 py-2 text-sm font-medium text-white bg-[#634600] hover:bg-[#56432C] rounded-lg transition-colors flex-shrink-0">
                                Unblock
                            </button>
                        </div>
                    `).join('')}
                </div>
            `;
        }
        
        function unblockUser(userId, userName) {
            if (!confirm(`Are you sure you want to unblock ${userName}? You will be able to receive messages from them again.`)) {
                return;
            }
            
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/users/${userId}/unblock`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || 'Failed to unblock user');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification(`${userName} has been unblocked`, 'info');
                    // Refresh the blocked users list
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch('/users/blocked', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        }
                    })
                    .then(async response => {
                        if (response.ok) {
                            const data = await response.json();
                            if (data.success) {
                                updateBlockedUsersModal(data.blocked_users);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error refreshing blocked users:', error);
                    });
                } else {
                    showNotification(data.message || 'Failed to unblock user', 'error');
                }
            })
            .catch(error => {
                console.error('Error unblocking user:', error);
                showNotification(error.message || 'Failed to unblock user. Please try again.', 'error');
            });
        }
    </script>
</x-app-layout>

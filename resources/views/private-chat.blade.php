<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}</span>
                    </div>
                    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $recipient->fname }} {{ $recipient->lname }}
        </h2>
                        <p class="text-sm text-green-500 flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Online
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </button>
                <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </x-slot>

    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="recipient-id" content="{{ $recipient->id }}">
    <meta name="recipient-name" content="{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-[600px] flex">
                <!-- Conversations Sidebar -->
                <div class="w-80 bg-[#F4F2ED] border-r border-[#B59F84] flex flex-col">
                    <!-- Sidebar Header -->
                    <div class="p-4 border-b border-[#B59F84]">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-[#634600]">Messages</h2>
                            <button class="p-2 text-[#786126] hover:text-[#634600] hover:bg-[#B59F84] hover:bg-opacity-20 rounded-full transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Search -->
                        <div class="mt-3 relative">
                            <input type="text" placeholder="Search conversations..." 
                                   class="w-full pl-10 pr-4 py-2 border border-[#B59F84] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-transparent bg-white">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Conversations List -->
                    <div class="flex-1 overflow-y-auto">
                        @if($conversations->count() > 0)
                            @foreach($conversations as $conversation)
                                <a href="{{ route('private.chat', $conversation['user']->id) }}" 
                                   class="flex items-center p-4 hover:bg-[#B59F84] hover:bg-opacity-20 transition-colors {{ $conversation['user']->id == $recipient->id ? 'bg-[#B59F84] bg-opacity-30 border-r-2 border-[#634600]' : '' }}">
                                    <!-- Avatar -->
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">{{ substr($conversation['user']->fname, 0, 1) }}{{ substr($conversation['user']->lname, 0, 1) }}</span>
                                        </div>
                                        @if($conversation['unread_count'] > 0)
                                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-[#634600] text-white text-xs rounded-full flex items-center justify-center">
                                                {{ $conversation['unread_count'] > 9 ? '9+' : $conversation['unread_count'] }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Conversation Info -->
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-[#634600] truncate">
                                                {{ $conversation['user']->fname }} {{ $conversation['user']->lname }}
                                            </p>
                                            <p class="text-xs text-[#786126]">
                                                {{ $conversation['latest_message']->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="text-sm text-[#786126] truncate">
                                            {{ $conversation['latest_message']->message }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-[#B59F84] bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[#634600] text-sm">No conversations yet</p>
                                    <p class="text-[#786126] text-xs">Start chatting with someone!</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-1 flex flex-col">
                <!-- Chat Header -->
                <div class="bg-gradient-to-r from-[#634600] to-[#B59F84] px-6 py-4 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">{{ $recipient->fname }} {{ $recipient->lname }}</h3>
                                <p class="text-white text-sm opacity-80">Active now</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 hover:bg-white hover:bg-opacity-20 rounded-full transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-[#F4F2ED]" id="private-messages-container">
                    @if($privateMessages->count() > 0)
                    @foreach($privateMessages as $msg)
                            <div class="flex {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="flex max-w-xs lg:max-w-md {{ $msg->user_id === auth()->id() ? 'flex-row-reverse' : 'flex-row' }} items-end space-x-2">
                                    <!-- Avatar -->
                                    <div class="w-8 h-8 rounded-full flex-shrink-0 {{ $msg->user_id === auth()->id() ? 'ml-2' : 'mr-2' }}">
                                        @if($msg->user_id === auth()->id())
                                            <div class="w-8 h-8 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->fname, 0, 1) }}{{ substr(auth()->user()->lname, 0, 1) }}</span>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 bg-gradient-to-r from-[#B59F84] to-[#786126] rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-semibold">{{ substr($msg->user->fname, 0, 1) }}{{ substr($msg->user->lname, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Message Bubble -->
                                    <div class="flex flex-col {{ $msg->user_id === auth()->id() ? 'items-end' : 'items-start' }}">
                                        <div class="px-4 py-2 rounded-2xl {{ $msg->user_id === auth()->id() ? 'bg-gradient-to-r from-[#634600] to-[#B59F84] text-white rounded-br-md' : 'bg-white text-[#634600] rounded-bl-md shadow-sm border border-[#B59F84]' }}">
                                            <p class="text-sm">{{ $msg->message }}</p>
                                        </div>
                                        <div class="mt-1 {{ $msg->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                            <span class="text-xs text-[#786126]">{{ $msg->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-[#B59F84] bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <p class="text-[#634600] text-lg font-medium">Start a conversation</p>
                                <p class="text-[#786126] text-sm">Send your first message to {{ $recipient->fname }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Message Input -->
                <div class="p-6 bg-white border-t border-[#B59F84]">
                    <form id="private-chat-form" method="POST" action="{{ route('private.chat.send', $recipient->id) }}" data-ajax="true">
                        @csrf
                        <div class="flex items-end space-x-3">
                            <button type="button" class="p-2 text-[#786126] hover:text-[#634600] hover:bg-[#B59F84] hover:bg-opacity-20 rounded-full transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            </button>
                            <div class="flex-1 relative">
                            <input
                                type="text"
                                name="message"
                                    id="message-input"
                                    class="w-full border border-[#B59F84] rounded-full px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-transparent resize-none"
                                    placeholder="Type a message..."
                                required
                                    autocomplete="off"
                                >
                                <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-[#786126] hover:text-[#634600]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <button
                                type="submit"
                                class="bg-gradient-to-r from-[#634600] to-[#B59F84] hover:from-[#56432C] hover:to-[#a08e77] text-white p-3 rounded-full transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#634600] focus:ring-offset-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.getElementById('private-chat-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const url = form.action;
    const messageInput = form.querySelector('input[name="message"]');
    const message = messageInput.value.trim();
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const messagesContainer = document.getElementById('private-messages-container');

    if (!message) return; // Do not send empty messages

    // Show typing indicator
    showTypingIndicator();

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ message })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        // Clear input
        messageInput.value = '';
        
        // Remove typing indicator
        removeTypingIndicator();

        // Construct full user name safely
        const user = data.message.user;
        const userFullName = `${user.fname ?? ''} ${user.lname ?? ''}`.trim();

        // Create new message HTML with your app's color scheme
        const newMessageHTML = `
            <div class="flex justify-end">
                <div class="flex max-w-xs lg:max-w-md flex-row-reverse items-end space-x-2">
                    <!-- Avatar -->
                    <div class="w-8 h-8 rounded-full flex-shrink-0 ml-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">${user.fname.charAt(0)}${user.lname.charAt(0)}</span>
                        </div>
                    </div>
                    
                    <!-- Message Bubble -->
                    <div class="flex flex-col items-end">
                        <div class="px-4 py-2 rounded-2xl bg-gradient-to-r from-[#634600] to-[#B59F84] text-white rounded-br-md">
                            <p class="text-sm">${data.message.message}</p>
                        </div>
                        <div class="mt-1 text-right">
                            <span class="text-xs text-[#786126]">just now</span>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Remove empty state if it exists
        const emptyState = messagesContainer.querySelector('.flex.items-center.justify-center.h-full');
        if (emptyState) {
            emptyState.remove();
        }

        // Note: Message will be added via real-time broadcasting
        // No need to manually add it here to avoid duplicates
        console.log('Message sent successfully:', data.message);
    })
    .catch(error => {
        console.error('Error:', error);
        removeTypingIndicator();
        showNotification('Failed to send message.', 'error');
    });
});

// Typing indicator functions
function showTypingIndicator() {
    const messagesContainer = document.getElementById('private-messages-container');
    const typingHTML = `
        <div class="flex justify-start" id="typing-indicator">
            <div class="flex max-w-xs lg:max-w-md flex-row items-end space-x-2">
                <div class="w-8 h-8 rounded-full flex-shrink-0 mr-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}</span>
                    </div>
                </div>
                <div class="px-4 py-2 rounded-2xl bg-white text-gray-800 rounded-bl-md shadow-sm border">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
    messagesContainer.insertAdjacentHTML('beforeend', typingHTML);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function removeTypingIndicator() {
    const typingIndicator = document.getElementById('typing-indicator');
    if (typingIndicator) {
        typingIndicator.remove();
    }
}

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Auto-resize input
const messageInput = document.getElementById('message-input');
messageInput.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
});

// Enter key to send message
messageInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('private-chat-form').dispatchEvent(new Event('submit'));
    }
});

// Auto-scroll to bottom on page load
window.addEventListener('load', function() {
    const messagesContainer = document.getElementById('private-messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
});

// Function to show typing indicator
function showTypingIndicator() {
    const container = document.getElementById('private-messages-container');
    if (!container) return;

    const typingHTML = `
        <div class="flex justify-start" id="typing-indicator">
            <div class="flex max-w-xs lg:max-w-md flex-row items-end space-x-2">
                <!-- Avatar -->
                <div class="w-8 h-8 rounded-full flex-shrink-0 mr-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-[#B59F84] to-[#786126] rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">${document.querySelector('meta[name="recipient-name"]')?.content || 'U'}</span>
                    </div>
                </div>
                
                <!-- Typing Bubble -->
                <div class="flex flex-col items-start">
                    <div class="px-4 py-2 rounded-2xl bg-white text-[#634600] rounded-bl-md shadow-sm border border-[#B59F84]">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-[#786126] rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-[#786126] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-[#786126] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', typingHTML);
    container.scrollTop = container.scrollHeight;
}

// Function to remove typing indicator
function removeTypingIndicator() {
    const typingIndicator = document.getElementById('typing-indicator');
    if (typingIndicator) {
        typingIndicator.remove();
    }
}
</script>

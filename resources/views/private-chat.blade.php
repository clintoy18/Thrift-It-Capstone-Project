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
        </div>
    </x-slot>

    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="recipient-id" content="{{ $recipient->id }}">
    <meta name="recipient-name" content="{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}">

    <div class="py-0 sm:py-6">
        <div class="max-w-7xl mx-auto px-0 sm:px-4 lg:px-8">
            <!-- Mobile Header with Conversations Toggle -->
            <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-20">
                <button id="conversations-toggle" class="flex items-center gap-3 text-[#634600] hover:text-[#56432C] transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <span class="font-semibold">Messages</span>
                </button>
                <div class="flex items-center gap-2">
                    <button class="p-2 text-[#634600] hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-[#634600] hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bg-white lg:rounded-2xl lg:shadow-xl overflow-hidden h-[calc(100vh-100px)] lg:h-[calc(100vh-120px)] flex flex-col lg:flex-row">
                <!-- Conversations Sidebar - Hidden on mobile by default -->
                <div id="conversations-sidebar" class="hidden lg:flex lg:w-80 bg-white lg:bg-[#F4F2ED] border-r border-gray-200 lg:border-[#B59F84] flex-col transition-all duration-300 absolute lg:relative z-30 w-full h-full lg:h-auto">
                    <!-- Mobile Header -->
                    <div class="lg:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-[#634600]">Messages</h2>
                        <button id="close-conversations" class="p-2 text-[#634600] hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar Header -->
                    <div class="hidden lg:block p-4 border-b border-[#B59F84]">
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
                                   class="w-full pl-10 pr-4 py-2 border border-[#B59F84] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-transparent bg-white text-sm">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Mobile Search -->
                    <div class="lg:hidden p-4 border-b border-gray-200">
                        <div class="relative">
                            <input type="text" placeholder="Search conversations..." 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-transparent bg-gray-50 text-sm">
                            <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Conversations List -->
                    <div class="flex-1 overflow-y-auto">
                        @if($conversations->count() > 0)
                            @foreach($conversations as $conversation)
                                <a href="{{ route('private.chat', $conversation['user']->id) }}" 
                                   class="flex items-center p-4 hover:bg-gray-50 lg:hover:bg-[#B59F84] lg:hover:bg-opacity-20 transition-colors border-b border-gray-100 lg:border-[#B59F84] lg:border-opacity-20 {{ $conversation['user']->id == $recipient->id ? 'bg-gray-50 lg:bg-[#B59F84] lg:bg-opacity-30 lg:border-r-2 lg:border-[#634600]' : '' }}">
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
                                            <p class="text-sm font-semibold text-gray-900 lg:text-[#634600] truncate">
                                                {{ $conversation['user']->fname }} {{ $conversation['user']->lname }}
                                            </p>
                                            <p class="text-xs text-gray-500 lg:text-[#786126] whitespace-nowrap ml-2">
                                                {{ $conversation['latest_message']->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="text-sm text-gray-600 lg:text-[#786126] truncate mt-1">
                                            {{ $conversation['latest_message']->message }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-full p-4">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-[#B59F84] bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[#634600] text-sm">No conversations yet</p>
                                    <p class="text-[#786126] text-xs mt-1">Start chatting with someone!</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-1 flex flex-col w-full">
                    <!-- Chat Header -->
                    <div class="bg-white lg:bg-gradient-to-r lg:from-[#634600] lg:to-[#B59F84] border-b border-gray-200 lg:border-none px-4 sm:px-6 py-3 sm:py-4 text-gray-900 lg:text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- Mobile Back Button -->
                                <button id="mobile-back-button" class="lg:hidden text-gray-600 hover:text-gray-800 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-[#634600] to-[#B59F84] lg:bg-white lg:bg-opacity-20 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($recipient->fname, 0, 1) }}{{ substr($recipient->lname, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-base sm:text-lg">{{ $recipient->fname }} {{ $recipient->lname }}</h3>
                                    <p class="text-gray-500 lg:text-white text-xs sm:text-sm lg:opacity-80">Active now</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 text-gray-600 lg:text-white hover:bg-gray-100 lg:hover:bg-white lg:hover:bg-opacity-20 rounded-full transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 text-gray-600 lg:text-white hover:bg-gray-100 lg:hover:bg-white lg:hover:bg-opacity-20 rounded-full transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Container - FIXED HEIGHT -->
                    <div class="flex-1 overflow-y-auto p-3 sm:p-6 space-y-4 bg-gray-50 lg:bg-[#F4F2ED] relative" id="private-messages-container">
                        <!-- Scroll to Bottom Button -->
                        <button id="scroll-to-bottom" class="fixed bottom-20 right-4 lg:right-8 bg-[#634600] text-white p-3 rounded-full shadow-lg hover:bg-[#56432C] transition-all duration-200 z-20 hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>
                        
                        @if($privateMessages->count() > 0)
                            @foreach($privateMessages as $msg)
                                <div class="flex {{ $msg->user_id === auth()->id() ? 'justify-end' : 'justify-start' }} message-item">
                                    <div class="flex max-w-[85%] sm:max-w-xs lg:max-w-md {{ $msg->user_id === auth()->id() ? 'flex-row-reverse' : 'flex-row' }} items-end space-x-2">
                                        <!-- Avatar -->
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full flex-shrink-0 {{ $msg->user_id === auth()->id() ? 'ml-1 sm:ml-2' : 'mr-1 sm:mr-2' }}">
                                            @if($msg->user_id === auth()->id())
                                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center">
                                                    <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->fname, 0, 1) }}{{ substr(auth()->user()->lname, 0, 1) }}</span>
                                                </div>
                                            @else
                                                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-[#B59F84] to-[#786126] rounded-full flex items-center justify-center">
                                                    <span class="text-white text-xs font-semibold">{{ substr($msg->user->fname, 0, 1) }}{{ substr($msg->user->lname, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Message Bubble -->
                                        <div class="flex flex-col {{ $msg->user_id === auth()->id() ? 'items-end' : 'items-start' }}">
                                            <div class="px-4 py-3 rounded-2xl text-sm {{ $msg->user_id === auth()->id() ? 'bg-gradient-to-r from-[#634600] to-[#B59F84] text-white rounded-br-md' : 'bg-white text-[#634600] rounded-bl-md shadow-sm border border-[#B59F84]' }}">
                                                <div class="text-sm whitespace-pre-line break-words">{!! preg_replace('/https?:\/\/[^\s]+\/products\/\d+/', '', nl2br(e($msg->message))) !!}</div>
                                                
                                                <!-- Product Preview Card (if message contains product link) -->
                                                @php
                                                    $productUrlPattern = '/\/products\/(\d+)/';
                                                    preg_match($productUrlPattern, $msg->message, $matches);
                                                    $productId = $matches[1] ?? null;
                                                @endphp
                                                
                                                @if($productId)
                                                    @php
                                                        $product = \App\Models\Product::find($productId);
                                                    @endphp
                                                    @if($product)
                                                        <div class="mt-2 p-2 bg-white bg-opacity-20 rounded-lg border border-white border-opacity-30 group">
                                                            <div class="flex gap-2">
                                                                @if($product->first_image)
                                                                    <img src="{{ asset('storage/' . $product->first_image) }}" 
                                                                         alt="{{ $product->name }}" 
                                                                         class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded-lg">
                                                                @endif
                                                                <div class="flex-1 min-w-0">
                                                                    <h4 class="font-semibold text-xs sm:text-sm truncate">{{ $product->name }}</h4>
                                                                    <p class="text-xs opacity-80 truncate">{{ $product->category->name ?? 'No Category' }}</p>
                                                                    @if($product->listingtype !== 'for donation')
                                                                        <p class="text-xs font-bold">₱{{ number_format($product->price, 2) }}</p>
                                                                    @else
                                                                        <p class="text-xs font-bold text-green-400">For Donation</p>
                                                                    @endif
                                                                    
                                                                    <!-- Hidden link that shows on hover -->
                                                                    <div class="mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                                        <a href="{{ route('products.show', $product->id) }}" 
                                                                           target="_blank" 
                                                                           class="text-xs text-blue-300 hover:text-blue-200 underline">
                                                                            🔗 View Product
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <!-- Timestamp - Moved outside the bubble -->
                                            <div class="mt-1 {{ $msg->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                                <span class="text-xs text-gray-500 lg:text-[#786126] px-2">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center h-full p-4">
                                <div class="text-center">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#B59F84] bg-opacity-30 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#786126]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[#634600] text-base sm:text-lg font-medium">Start a conversation</p>
                                    <p class="text-[#786126] text-sm mt-1">Send your first message to {{ $recipient->fname }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Message Input - COMPACT DESIGN -->
                    <div class="p-3 sm:p-4 bg-white border-t border-gray-200 lg:border-[#B59F84] shadow-sm sticky bottom-0 z-10 w-full">
                        <form id="private-chat-form" method="POST" action="{{ route('private.chat.send', $recipient->id) }}" data-ajax="true">
                            @csrf
                            <div class="flex items-center space-x-2 w-full">
                                <button type="button" class="p-2 text-gray-500 lg:text-[#786126] hover:text-gray-700 lg:hover:text-[#634600] hover:bg-gray-100 lg:hover:bg-[#B59F84] lg:hover:bg-opacity-20 rounded-full transition-colors flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </button>
                                <div class="flex-1 relative min-w-0">
                                    <input
                                        type="text"
                                        name="message"
                                        id="message-input"
                                        class="w-full border border-gray-300 lg:border-[#B59F84] rounded-full px-4 py-3 pr-10 focus:outline-none focus:ring-2 focus:ring-[#634600] focus:border-[#634600] resize-none text-sm bg-white text-gray-900 placeholder-gray-500 min-h-[44px]"
                                        placeholder="Type a message..."
                                        required
                                        autocomplete="off"
                                    >
                                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 lg:text-[#786126] hover:text-gray-600 lg:hover:text-[#634600]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <button
                                    type="submit"
                                    class="bg-gradient-to-r from-[#634600] to-[#B59F84] hover:from-[#56432C] hover:to-[#a08e77] text-white p-3 rounded-full transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#634600] focus:ring-offset-2 flex-shrink-0 min-h-[44px]"
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

    <script>
    // Enhanced Mobile navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
        const conversationsToggle = document.getElementById('conversations-toggle');
        const conversationsSidebar = document.getElementById('conversations-sidebar');
        const closeConversations = document.getElementById('close-conversations');
        const mobileBackButton = document.getElementById('mobile-back-button');
        const chatArea = document.querySelector('.flex-1.flex-col');

        // Add smooth slide animations
        function showConversations() {
            conversationsSidebar.classList.remove('hidden');
            conversationsSidebar.style.transform = 'translateX(0)';
            chatArea.style.transform = 'translateX(100%)';
            setTimeout(() => {
                chatArea.classList.add('hidden');
            }, 300);
        }

        function showChat() {
            conversationsSidebar.style.transform = 'translateX(-100%)';
            chatArea.classList.remove('hidden');
            chatArea.style.transform = 'translateX(0)';
            setTimeout(() => {
                conversationsSidebar.classList.add('hidden');
            }, 300);
        }

        // Initialize transforms
        conversationsSidebar.style.transition = 'transform 0.3s ease-in-out';
        chatArea.style.transition = 'transform 0.3s ease-in-out';

        // Toggle conversations sidebar on mobile
        if (conversationsToggle) {
            conversationsToggle.addEventListener('click', function() {
                showConversations();
            });
        }

        // Close conversations sidebar on mobile
        if (closeConversations) {
            closeConversations.addEventListener('click', function() {
                showChat();
            });
        }

        // Mobile back button functionality
        if (mobileBackButton) {
            mobileBackButton.addEventListener('click', function() {
                showConversations();
            });
        }

        // Close sidebar when clicking on a conversation (mobile)
        const conversationLinks = document.querySelectorAll('a[href*="private.chat"]');
        conversationLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    showChat();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                conversationsSidebar.classList.remove('hidden');
                chatArea.classList.remove('hidden');
                conversationsSidebar.style.transform = '';
                chatArea.style.transform = '';
            }
        });
    });

    // Chat functionality
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

            // Create new message HTML
            const newMessageHTML = `
                <div class="flex justify-end message-item">
                    <div class="flex max-w-[85%] sm:max-w-xs lg:max-w-md flex-row-reverse items-end space-x-2">
                        <!-- Avatar -->
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full flex-shrink-0 ml-1 sm:ml-2">
                            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">${user.fname.charAt(0)}${user.lname.charAt(0)}</span>
                            </div>
                        </div>
                        
                        <!-- Message Bubble -->
                        <div class="flex flex-col items-end">
                            <div class="px-4 py-3 rounded-2xl bg-gradient-to-r from-[#634600] to-[#B59F84] text-white rounded-br-md">
                                <div class="text-sm whitespace-pre-line break-words">${data.message.message.replace(/\n/g, '<br>')}</div>
                            </div>
                            <div class="mt-1 text-right">
                                <span class="text-xs text-gray-500 lg:text-[#786126] px-2">just now</span>
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

            // Add the new message
            messagesContainer.insertAdjacentHTML('beforeend', newMessageHTML);
            
            // Scroll to bottom after sending message
            setTimeout(() => {
                scrollToBottom(true);
            }, 100);
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
                <div class="flex max-w-[85%] sm:max-w-xs lg:max-w-md flex-row items-end space-x-2">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full flex-shrink-0 mr-1 sm:mr-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-r from-[#B59F84] to-[#786126] rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">${document.querySelector('meta[name="recipient-name"]')?.content || 'U'}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-start">
                        <div class="px-4 py-3 rounded-2xl bg-white text-[#634600] rounded-bl-md shadow-sm border border-[#B59F84]">
                            <div class="flex space-x-1">
                                <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#786126] rounded-full animate-bounce"></div>
                                <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#786126] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#786126] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        messagesContainer.insertAdjacentHTML('beforeend', typingHTML);
        scrollToBottom(true);
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
        notification.className = `fixed top-4 right-4 p-3 sm:p-4 rounded-lg shadow-lg z-50 text-sm sm:text-base ${
            type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Enter key to send message
    const messageInput = document.getElementById('message-input');
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('private-chat-form').dispatchEvent(new Event('submit'));
        }
    });

    // Enhanced scroll functionality
    function scrollToBottom(smooth = true) {
        const messagesContainer = document.getElementById('private-messages-container');
        if (messagesContainer) {
            if (smooth) {
                messagesContainer.scrollTo({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth'
                });
            } else {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }
    }

    function checkScrollPosition() {
        const messagesContainer = document.getElementById('private-messages-container');
        const scrollButton = document.getElementById('scroll-to-bottom');
        
        if (messagesContainer && scrollButton) {
            const isAtBottom = messagesContainer.scrollTop + messagesContainer.clientHeight >= messagesContainer.scrollHeight - 100;
            
            if (isAtBottom) {
                scrollButton.classList.add('hidden');
            } else {
                scrollButton.classList.remove('hidden');
            }
        }
    }

    // Add scroll event listener
    const messagesContainer = document.getElementById('private-messages-container');
    if (messagesContainer) {
        messagesContainer.addEventListener('scroll', checkScrollPosition);
    }

    // Scroll to bottom button functionality
    const scrollButton = document.getElementById('scroll-to-bottom');
    if (scrollButton) {
        scrollButton.addEventListener('click', function() {
            scrollToBottom(true);
        });
    }

    // Auto-scroll to bottom on page load
    window.addEventListener('load', function() {
        scrollToBottom(false); // Instant scroll on load
    
        // Check for auto-message parameter and send message automatically
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('auto_message') === '1') {
            setTimeout(() => {
                const messageInput = document.getElementById('message-input');
                const form = document.getElementById('private-chat-form');
                
                if (messageInput && form) {
                    const productId = urlParams.get('product_id');
                    const productName = urlParams.get('product_name');
                    const productImage = urlParams.get('product_image');
                    
                    if (productId && productName) {
                        const productUrl = `${window.location.origin}/products/${productId}`;
                        let message = `Is this available?\n\n📦 ${decodeURIComponent(productName)}\n🔗 ${productUrl}`;
                        
                        if (productImage) {
                            message += ``;
                        }
                        
                        messageInput.value = message;
                    } else {
                        messageInput.value = 'Is this available?';
                    }
                    
                    form.dispatchEvent(new Event('submit'));
                    
                    // Remove all auto-message parameters from URL
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.delete('auto_message');
                    newUrl.searchParams.delete('product_id');
                    newUrl.searchParams.delete('product_name');
                    newUrl.searchParams.delete('product_image');
                    window.history.replaceState({}, '', newUrl);
                }
            }, 1000);
        }
    });
    </script>

    <style>
        /* Ensure proper spacing for messages */
        .message-item {
            margin-bottom: 1rem;
        }
        
        /* Make sure messages container has proper height */
        #private-messages-container {
            min-height: 300px;
            max-height: calc(100vh - 240px);
            padding-bottom: 1rem;
        }
        
        /* Compact message input */
        #message-input {
            min-height: 40px;
            font-size: 14px;
        }
        
        /* Ensure timestamps are visible */
        .text-xs.text-gray-500 {
            color: #6b7280 !important;
            font-size: 11px;
        }
        
        /* Mobile optimizations */
        @media (max-width: 1023px) {
            #private-messages-container {
                max-height: calc(100vh - 180px);
                padding: 1rem;
                padding-bottom: 80px; /* Add space for input area */
            }
            
            .message-item {
                margin-bottom: 0.75rem;
            }
            
            /* Ensure input area is always visible on mobile */
            .bg-white.border-t {
                position: sticky;
                bottom: 0;
                z-index: 20;
                background: white;
                border-top: 1px solid #e5e7eb;
            }
        }
        
        /* Desktop optimizations */
        @media (min-width: 1024px) {
            #private-messages-container {
                max-height: calc(100vh - 240px);
            }
        }
    </style>
</x-app-layout>
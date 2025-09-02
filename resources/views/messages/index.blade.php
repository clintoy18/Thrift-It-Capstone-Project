<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Messages
            </h2>
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                                   class="flex items-center p-4 hover:bg-[#B59F84] hover:bg-opacity-20 transition-colors">
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

                <!-- Welcome Area -->
                <div class="flex-1 flex items-center justify-center bg-[#F4F2ED]">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-[#634600] to-[#B59F84] rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#634600] mb-2">Welcome to Messages</h3>
                        <p class="text-[#786126] mb-6">Select a conversation from the sidebar to start chatting</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#634600] text-white rounded-lg hover:bg-[#56432C] transition-colors">
                                Browse Products
                            </a>
                            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-[#B59F84] text-[#634600] rounded-lg hover:bg-[#B59F84] hover:bg-opacity-20 transition-colors">
                                My Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

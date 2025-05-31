<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <!-- Two-Column Layout -->
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Left Column: Multiple Images -->
                <div class="md:w-1/3 flex flex-col gap-4">
                    <!-- Main Image (or multiple stacked images) -->
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-64 object-cover rounded-lg"
                    >
                    <!-- Additional images (static placeholders for now) -->
                    <img 
                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="Additional 1"
                        class="w-full h-64 object-cover rounded-lg"
                    >
                    <img 
                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="Additional 2"
                        class="w-full h-64 object-cover rounded-lg"
                    >
                </div>

                <!-- Right Column: User Info, Product Details, Comments -->
                <div class="md:w-2/3 flex flex-col gap-6">

                    <!-- User & Rating Section -->
                    <div class="flex items-center gap-4">
                        <!-- Avatar -->
                        {{-- <img 
                            src="{{ $product->user->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                            alt="{{ $product->user->fname }} {{ $product->user->lname }}"
                            class="w-12 h-12 rounded-full"
                        > --}}
                        <div class="flex flex-col">
                            <p class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ $product->user->fname }} {{ $product->user->lname }}
                            </p>
                            <!-- Static rating for demonstration -->
                            <div class="flex items-center text-sm text-yellow-500">
                                <span class="mr-1">★★★★★</span>
                                <span class="text-gray-500"> (5)</span>
                            </div>
                        </div>
                       <!-- Action Buttons -->
                            <div class="ml-auto flex gap-2 text-sm">
                                <!-- Message Seller -->
                                <a href="{{ route('private.chat', $product->user->id) }}"
                                class="flex items-center gap-1 px-3 py-1.5 border border-gray-300 text-gray-700 rounded hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    Message
                                </a>

                                <!-- Visit Profile -->
                                <a href="{{ route('profile.show', $product->user->id) }}"
                                class="flex items-center gap-1 px-3 py-1.5 border border-gray-300 text-gray-700 rounded hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 14c-2.5 0-4 1.5-4 3v1h8v-1c0-1.5-1.5-3-4-3z"/>
                                        <circle cx="12" cy="8" r="3"/>
                                    </svg>
                                    Profile
                                </a>

                                <!-- Report User -->
                                @if(Auth::id() !== $product->user_id)
                                    <a href="{{ route('reports.create', $product->user->id) }}"
                                    class="flex items-center gap-1 px-3 py-1.5 border border-red-300 text-red-600 rounded hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 9v2m0 4h.01M5.455 4.455a2.836 2.836 0 012-1.455h9.09a2.836 2.836 0 012 1.455l3.182 5.455a2.836 2.836 0 010 2.182L18.545 17.09a2.836 2.836 0 01-2 1.455H7.455a2.836 2.836 0 01-2-1.455L2.273 12.09a2.836 2.836 0 010-2.182L5.455 4.455z"/>
                                        </svg>
                                        Report
                                    </a>
                                @endif
                            </div>

                    </div>

                    <!-- Product Title & Short Info -->
                    <div>
                        <h1 class="text-2xl font-bold mb-1">
                            {{ $product->name }}
                        </h1>
                        <!-- Example: "Size: L . Excellent condition . Carhart" -->
                        <p class="text-sm text-gray-600">
                            Size: {{ $product->size }} · 
                            {{ ucfirst($product->condition) }} condition · 
                            {{ $product->category->name ?? 'No Category' }}
                        </p>
                    </div>

                 <!-- Product Details -->
                    <div class="space-y-2">
                        <h2 class="font-semibold text-gray-800 dark:text-gray-200">Details</h2>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        
                        @if($product->listingtype === 'for donation')
                            <p class="text-lg font-bold text-green-600">For Donation</p>
                        @else
                            <p class="text-lg font-bold text-gray-900">₱{{ number_format($product->price, 2) }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-500">Quantity: {{ $product->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($product->status) }}</p>
                        
                        <!-- Show Update Button if User Owns the Product -->
                        @if(Auth::id() === $product->user_id)
                            <a href="{{ route('products.edit', $product->id) }}" 
                                class="inline-block mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                Update Product
                            </a>
                        @endif
                    </div>



                   <!-- Comments Section -->
                <div class="border p-6 rounded-lg shadow bg-gray-100 dark:bg-gray-800">
                    <h3 class="text-lg font-bold mb-4">Comments</h3>

                    <!-- Scrollable Comment List -->
                    <div class="max-h-60 overflow-y-auto space-y-4 pr-2">
                        @forelse($product->comments as $comment)
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                <div class="flex items-center gap-3">
                                    <!-- User Profile Picture -->
                                    <img 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->fname . ' ' . $comment->user->lname) }}&background=random" 
                                        alt="{{ $comment->user->fname }} {{ $comment->user->lname }}"
                                        class="w-10 h-10 rounded-full border"
                                    >

                                    <!-- User Info -->
                                    <div>
                                        <a href="{{ route('profile.show', $comment->user->id) }}" class="text-blue-500 hover:underline">
                                        
                                        
                                        <p class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $comment->user->fname }} {{ $comment->user->lname }}
                                        </p>
                                        </a>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Comment Content -->
                                <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                               
                                <!-- Delete Button (Only for Comment Owner) -->
                                @if(Auth::id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400 text-sm">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>

                    <!-- Comment Form -->
                    @auth
                        <form action="{{ route('comments.store', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="content" rows="3" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300" required></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 ">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <p class="mt-3 text-gray-600">
                            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to comment.
                        </p>
                    @endauth
                </div>

                    <!-- Back to Products -->
                    <a 
                        href="{{ route('products.index') }}" 
                        class="mt-4 inline-block text-blue-500 hover:underline"
                    >
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

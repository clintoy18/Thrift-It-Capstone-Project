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
                        <!-- Visit Profile Button -->
                        <a href="{{ route('profile.show', $product->user->id) }}" 
                            class="ml-auto px-4 py-2 text-sm border rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                        >
                            Visit Profile
                        </a>
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

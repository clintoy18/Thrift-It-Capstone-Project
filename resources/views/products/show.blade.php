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
                        <a 
                            href="#" 
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
                    <div>
                        <h2 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Details</h2>
                        <!-- Example details text -->
                        <p class="text-gray-600 mb-2">
                            {{ $product->description }}
                        </p>
                        <!-- Example: "Min: 1500", "Steal: 2000", "Lock: 3000" -->
                        @if($product->listingtype === 'for donation')
                            <p class="text-lg font-bold text-green-600 mb-2">For Donation</p>
                        @else
                            <p class="text-lg font-bold text-gray-900 mb-2">
                                ₱{{ number_format($product->price, 2) }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-500">Quantity: {{ $product->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($product->status) }}</p>
                    </div>

                        <!-- Comments Section -->
                        <div class="border p-6 rounded-lg shadow bg-gray-100 dark:bg-gray-800">
                            <h3 class="text-lg font-bold mb-4">Comments</h3>

                            <div class="max-h-96 overflow-y-auto space-y-4 pr-2">
                                @foreach($product->comments->where('parent_id', null) as $comment)
                                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                        <div class="flex items-start gap-3">
                                            <img 
                                                src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->fname . ' ' . $comment->user->lname) }}&background=random" 
                                                class="w-10 h-10 rounded-full border"
                                            >
                                            <div class="w-full">
                                                <div class="flex justify-between items-center">
                                                    <p class="font-semibold text-gray-800 dark:text-gray-200">
                                                        {{ $comment->user->fname }} {{ $comment->user->lname }}
                                                    </p>
                                                    <div class="flex gap-2">
                                                        <p class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                                                        
                                                        @if(auth()->id() == $comment->user_id)
                                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                                <p class="text-gray-800">{{ $comment->content }}</p>

                                                <!-- Reply Button -->
                                                <button class="text-blue-500 text-sm hover:underline" onclick="toggleReplyForm({{ $comment->id }})">
                                                    Reply
                                                </button>

                                                <!-- Reply Form (Appears Directly Below the Comment) -->
                                                <div id="reply-form-{{ $comment->id }}" class="hidden mt-2 ml-12">
                                                    <form action="{{ route('comments.store', $product->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <textarea name="content" rows="2" class="w-full border rounded-lg p-2"></textarea>
                                                        <button type="submit" class="mt-2 px-4 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                                            Reply
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Replies (Properly Nested) -->
                                                <div id="replies-{{ $comment->id }}" class="ml-8 mt-3 space-y-2">
                                                    @foreach($comment->replies as $reply)
                                                        <div class="bg-gray-200 dark:bg-gray-800 p-3 rounded-lg flex items-start gap-3">
                                                            <img 
                                                                src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->fname . ' ' . $reply->user->lname) }}&background=random" 
                                                                class="w-8 h-8 rounded-full border"
                                                            >
                                                            <div class="w-full">
                                                                <div class="flex justify-between items-center">
                                                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                                                        <strong>{{ $reply->user->fname }} {{ $reply->user->lname }}</strong>
                                                                    </p>
                                                                    <div class="flex gap-2">
                                                                        <p class="text-xs text-gray-600">{{ $reply->created_at->diffForHumans() }}</p>

                                                                        @if(auth()->id() == $reply->user_id)
                                                                            <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="text-red-500 text-xs hover:underline">Delete</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <p class="text-gray-800">{{ $reply->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <script>
                        function toggleReplyForm(commentId) {
                            let form = document.getElementById('reply-form-' + commentId);
                            if (form) {
                                form.classList.toggle('hidden');
                            }
                        }
                        </script>



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

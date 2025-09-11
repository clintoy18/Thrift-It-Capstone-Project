<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto p-4">
            <!-- Two-Column Layout -->
            <div class="flex flex-col md:flex-row gap-6">
                
               <div class="md:w-1/3 flex flex-col gap-6">
                <div class="swiper mySwiper rounded-lg overflow-hidden">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="{{ $product->name }}"
                                class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="Additional 1"
                                class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                        </div>
                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                        alt="Additional 2"
                                class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                        </div>
                    </div>
                    <!-- Pagination (dots) -->
                    <div class="swiper-pagination"></div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                 <!-- Product Title & Short Info -->
                 <hr class="w-full mt-1 h-px bg-gray-800 border-0 dark:bg-gray-700">
               <div>
                
                        <h1 class="text-2xl font-bold mb-1">
                            {{ $product->name }}
                        </h1>
                        <p class="text-sm text-gray-600">
                            Size: {{ $product->size }} · 
                            {{ ucfirst($product->condition) }} condition · 
                            {{ $product->category->name ?? 'No Category' }}
                        </p>
                    </div>
                    <hr class="w-full mt-1 h-px bg-gray-800 border-0 dark:bg-gray-700">
                     <!-- Product Details -->
                     <div class="space-y-2">
                        <h2 class=" text-xl  font-semibold text-gray-800 dark:text-gray-200 text-center">Details</h2>
                        <h2 class=" text-xl  text-gray-800 dark:text-gray-200 ">Condition</h2>
                        <h2 class="text-xl text-gray-800 dark:text-gray-200 flex flex-col relative top-[-32px] text-right"> New </h2>
    
                        <p class="text-gray-600 flex flex-col relative top-[-32px]">{{ $product->description }}</p>
                        <p class="text-gray-600 flex flex-col relative top-[-32px]">Mine: 1500</p>
                        <p class="text-gray-600 flex flex-col relative top-[-32px]">Steal: 2000</p>
                        <p class="text-gray-600 flex flex-col relative top-[-32px]">Lock: 3000(Automatically Yours)</p>
                        <div class="flex justify-center">
                                <a class="inline-block mt-3 px-4 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] w-full sm:w-auto text-center">
                                    Purchase Item
                                </a>
                                </div>

                </div>

            </div>
             

                 
                <!-- Right Column: User Info, Product Details, Comments -->
                <div class="md:w-2/3 flex flex-col gap-9">

                    <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-32 bg-gradient-to-r from-blue-400 to-purple-500">                                        
                            <!-- You can replace this with an actual background image -->
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        </div>
                        
                        <!-- User Info Section -->
                        <div class="relative bg-[#E1D5B6] p-4">
                            <!-- Avatar -->
                            <div class="absolute -top-8 left-4 w-16 h-16 bg-white dark:bg-gray-700 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                    {{ strtoupper(substr($product->user->fname, 0, 1) . substr($product->user->lname, 0, 1)) }}
                                </span>
                            </div>
                            
                            <!-- User Details -->
                            <div class="flex items-start justify-between pt-4">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">
                                        {{ $product->user->fname }}{{ $product->user->lname }}_14
                                    </h3>
                                    <!-- Rating -->
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-500">
                                            <span>★★★★★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(5)</span>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2 ml-4">
                                    <!-- Add Friend Button -->
                                    <a href="{{ route('private.chat', $product->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Message
                                    </a>
                                    
                                    <!-- Visit Profile Button -->
                                    <a href="{{ route('profile.show', $product->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Visit Profile
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Report Button (if not the owner) -->
                            @if(Auth::id() !== $product->user_id)
                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('reports.create', $product->user->id) }}"
                                       class="inline-flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M12 9v2m0 4h.01M5.455 4.455a2.836 2.836 0 012-1.455h9.09a2.836 2.836 0 012 1.455l3.182 5.455a2.836 2.836 0 010 2.182L18.545 17.09a2.836 2.836 0 01-2 1.455H7.455a2.836 2.836 0 01-2-1.455L2.273 12.09a2.836 2.836 0 010-2.182L5.455 4.455z"/>
                                        </svg>
                                        Report User
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-2">
                      
                        
                        @if($product->listingtype === 'for donation')
                            <p class="text-lg font-bold text-green-600">For Donation</p>
                        @else
                            <p class="text-lg font-bold text-gray-900">₱{{ number_format($product->price, 2) }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-500">Quantity: {{ $product->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($product->status) }}</p>
                        <p class="text-sm text-gray-500">
                            Location: {{ $product->barangay->name ?? 'N/A' }}, Cebu City, Cebu 6000
                        </p>
                        
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
                                          <img 
                                            src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->fname . ' ' . $comment->user->lname) }}&background=random" 
                                            alt="{{ $comment->user->fname }} {{ $comment->user->lname }}"
                                            class="w-10 h-10 rounded-full border"
                                        >
                                <div class="inline-block max-w-full bg-[#E1D5B6] dark:bg-gray-700 p-3 rounded-lg shadow">
                                    <div class="flex items-center gap-3">
                                       
                                        <div>
                                            <a href="{{ route('profile.show', $comment->user->id) }}" class="text-blue-500 hover:underline">
                                                <p class="font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $comment->user->fname }} {{ $comment->user->lname }}
                                                </p>
                                            </a>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="ml-auto flex gap-2">
                                            @if(Auth::id() === $comment->user_id)
                                                <a href="{{ route('comments.edit', $comment->id) }}" 
                                                   class="px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" 
                                                      class="inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-2 border-gray-200 dark:border-gray-600">
                                @endif
                            @empty
                                <p class="text-gray-600 dark:text-gray-400 text-sm">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>

                        <!-- Comment Form -->
                        @auth
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-4 flex items-start gap-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <img 
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->fname . ' ' . auth()->user()->lname) }}&background=random" 
                                    alt="{{ auth()->user()->fname }} {{ auth()->user()->lname }}"
                                    class="w-10 h-10 rounded-full border"
                                >
                                <div class="flex-1">
                                    <textarea name="content" rows="3" maxlength="1000"
                                              class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-300" 
                                              required
                                              oninput="document.getElementById('char-count').innerText = this.value.length + '/1000';"></textarea>
                                    <div class="flex justify-between items-center mt-2">
                                        <span id="char-count" class="text-xs text-gray-500">0/1000</span>
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="mt-3 text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to comment.
                            </p>
                        @endauth
                    </div>

                    <!-- Back to Products -->
                
                </div>
            </div>
            <h2 class=" text-xl  font-semibold text-gray-800 dark:text-gray-200 ">More for this Seller</h2>
           
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
              
                    <!-- Slide 1 -->
                    <div class="grid grid-cols-4 md:grid-cols-3 gap-6 p-4">
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                            alt="Additional 1"
                            class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                            alt="Additional 2"
                            class="w-full h-64 object-cover transition-transform duration-500 hover:scale-105">
                    </div>
                    </div>


                </div>

        </div>
        <div class="flex flex-col overflow-hidden ml-[60px]">
            <a 
                href="{{ route('products.index') }}" 
                class="flex items-center gap-2 text-[#B59F84] hover:underline"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-4 h-4" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7M3 12h18" />
                </svg>
                <span>Back to Products</span> 
            </a>
        </div>


                
        </div>
    </div>

 
</x-app-layout>

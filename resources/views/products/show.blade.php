<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $product->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 overflow-x-hidden">
        <div class="max-w-7xl mx-auto p-4 overflow-x-hidden">
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
                        <div class="relative h-32 bg-center bg-cover" style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">                                        
                            <div class="absolute inset-0 bg-black/20"></div>
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
                                        {{ $product->user->fname }}{{ $product->user->lname }}
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
                               class="inline-block mt-3 px-4 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition">
                                Update Product
                            </a>
                        @endif
                </div>

                    <!-- Comments Section -->
                    <div class="border p-6 rounded-lg shadow bg-[#F4F2ED]">
                        <h3 class="text-lg font-bold mb-4">Comments</h3>

                        <!-- Scrollable Comment List -->
                        <div class="max-h-60 overflow-y-auto overflow-x-hidden space-y-3 pr-2">
                            @forelse($product->comments as $comment)
                                <div class="flex items-start gap-3">
                                    <img 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->fname . ' ' . $comment->user->lname) }}&background=random" 
                                        alt="{{ $comment->user->fname }} {{ $comment->user->lname }}"
                                        class="w-10 h-10 rounded-full border"
                                    >
                                    <div class="inline-block max-w-full bg-[#E1D5B6] dark:bg-gray-700 p-3 rounded-lg ">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('profile.show', $comment->user->id) }}" class="text-blue-500 hover:underline">
                                                <p class="font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $comment->user->fname }} {{ $comment->user->lname }}
                                                </p>
                                            </a>
                                           
                                            @if(Auth::id() === $comment->user_id)
                                            <div class="ml-auto relative">
                                                <button type="button" class="p-1 rounded hover:bg-black/10 dark:hover:bg-white/10" onclick="toggleDropdown({{ $comment->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </button>
                                                <div id="dropdown-{{ $comment->id }}" class="absolute right-0 mt-1 w-28 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow z-10 hidden">
                                                    <a href="{{ route('comments.edit', $comment->id) }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Edit</a>
                                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <p class="mt-2 text-gray-800 dark:text-gray-200 break-words">{{ $comment->content }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col overflow-hidden relative left-[50px]">
                                <p class="text-gray-500   dark:text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
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
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full max-w-xl bg-white dark:bg-gray-800 p-3 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-md">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <textarea
                                        name="content"
                                        placeholder="Write a comment..."
                                        class="flex-1 w-full resize-none overflow-hidden rounded-full px-4 py-2 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#E1D5B6] border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700"
                                        rows="1"
                                        oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px';"
                                        required></textarea>
                                    <button type="submit"
                                        class="mt-2 md:mt-0 md:self-center bg-[#E1D5B6] text-white font-semibold px-4 py-2 rounded-full shadow hover:shadow-md hover:bg-[#d1c29f] transition-all duration-300 ease-in-out w-full md:w-auto">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
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

    <script>
        function toggleDropdown(commentId) {
            const dropdown = document.getElementById('dropdown-' + commentId);
            if (dropdown.classList.contains('hidden')) {
                // Close all other dropdowns first
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                // Open this dropdown
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".mySwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    });

    </script>

 
</x-app-layout>

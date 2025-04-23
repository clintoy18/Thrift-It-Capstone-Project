<x-app-layout>

    <!-- Full-width Jumbotron outside of the main content container -->
    <div class="w-full bg-[#D9D9D9] dark:bg-gray-800 shadow-sm py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile/Small screens layout (stacked) -->
            <div class="flex flex-col md:hidden">
                <!-- Text Content for Mobile -->
                <div class="p-2">
                    <h1 class="text-xl sm:text-2xl font-bold text-red-600 dark:text-red-400 leading-tight">
                        Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds
                    </h1>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Fashion meets purpose — shop, sell, and donate thrifted clothing to embrace a greener future.
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-colors">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md text-xs font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-colors">
                            Start Selling
                        </a>
                    </div>
                </div>
                
                <!-- Image for Mobile -->
                <div class="mt-2 relative rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/bgimages/jumbotron.png') }}" 
                        alt="Thrift-IT Sustainable Fashion" 
                        class="w-full max-h-[180px] object-contain">
                    <div class="absolute bottom-2 right-2 bg-white px-2 py-0.5 rounded-full text-xs text-red-600 font-medium shadow-md">
                        Sustainable fashion
                    </div>
                </div>
            </div>
            
            <!-- Desktop layout (side by side) -->
            <div class="hidden md:flex md:flex-row md:items-center md:py-2">
                <!-- Text Content for Desktop -->
                <div class="p-3 md:w-1/2">
                    <h1 class="text-5xl lg:text-4xl font-bold text-red-600 dark:text-red-400 leading-tight">
                        Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds
                    </h1>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                        Fashion meets purpose — shop, sell, and donate thrifted clothing to embrace a greener future.
                    </p>
                    <div class="mt-4">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-colors">
                            Explore Collection
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('products.create') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-colors">
                            Start Selling
                        </a>
                    </div>
                </div>
                
                <!-- Image for Desktop -->
                <div class="md:w-1/2 relative overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/bgimages/jumbotron.png') }}" 
                            alt="Thrift-IT Sustainable Fashion" 
                            class="w-full max-h-[440px] object-contain">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8">
            <!-- Section Title -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-red-600 dark:text-red-400">Featured Products</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Discover pre-loved treasures from our community</p>
            </div>
            
            <!-- Products Grid -->
            <div class="rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 md:p-6">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($products as $product)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <!-- Product Link Wrapper -->
                                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                        <!-- Badge (if product is for donation or on sale) -->
                                        @if($product->listingtype === 'for donation')
                                            <div class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif
                                        
                                        <!-- Image with overlay effect -->  
                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                                                alt="{{ $product->name }}" 
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                                
                                            <!-- Hover overlay with quick view option -->
                                            <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                    Quick view
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Product Details -->  
                                        <div class="p-2 sm:p-3 md:p-4">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm md:text-base font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 sm:px-2 sm:py-1 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>
                                            
                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs md:text-sm mt-0.5 sm:mt-1 truncate">
                                                {{ $product->category->name ?? 'No Category' }}
                                            </p>
                                            
                                            <div class="flex justify-between items-center mt-1 sm:mt-2 md:mt-3">
                                                <p class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-red-600' }}">
                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                </p>
                                                
                                                <!-- Favorite button outside of the link to prevent event bubbling -->
                                                <button class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors" 
                                                        data-id="{{ $product->id }}" 
                                                        type="button"
                                                        onclick="event.preventDefault(); event.stopPropagation();">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center bg-white dark:bg-gray-800 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No products available</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">Explore our categories or check back later for new arrivals</p>
                            <div class="mt-6">
                                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    List your first product
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle the favorite icon
                const svg = this.querySelector('svg');
                if (svg.getAttribute('fill') === 'none') {
                    svg.setAttribute('fill', 'currentColor');
                    svg.setAttribute('stroke', 'none');
                    this.classList.add('text-red-500');
                } else {
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', 'currentColor');
                    this.classList.remove('text-red-500');
                }
            });
        });
    </script>
    
    </div>
</x-app-layout>



<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-[#F4F2ED] h-[600px] overflow-hidden pt-20 md:pt-0">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col md:flex-row items-center justify-between">
            {{-- Text Content --}}
            <div class="w-full md:w-1/2 mb-8 md:mb-0 text-center md:text-left flex flex-col items-center md:items-start">
                <h1 class="text-4xl sm:text-5xl font-bold leading-tight text-[#634600]">Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds</h1>
                <p class="mt-4 text-lg leading-relaxed text-gray-700">Fashion meets purpose — shop, sell, and donate thrifted clothing to embrace a greener future.</p>
                <div class="mt-8 flex flex-row gap-3 items-center justify-center md:justify-start md:items-start">
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md text-sm font-semibold text-white bg-[#B59F84] shadow-md transform transition-all duration-200 hover:bg-[#a08e77] hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B59F84]">
                        Explore Collection
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md text-sm font-semibold text-white bg-gradient-to-r from-[#CBBC96] to-[#B59F84] shadow-md transform transition-all duration-200 hover:from-[#b3a87e] hover:to-[#a08e77] hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B59F84]">
                        Start Selling
                    </a>
                </div>
            </div>

            {{-- Image --}}
            <div class="w-full md:w-1/2 h-full flex items-center justify-center animate-fade-in-right">
                <img src="{{ asset('storage/bgimages/jumbotron.png') }}" alt="Hero Image" class="object-contain max-h-full w-auto mx-auto">
            </div>
        </div>
    </div>
    
    <div class="py-6 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8">
            <!-- Section Title -->
            <div class="mb-6 scroll-animate">
                <h2 class="text-xl font-bold text-[#56432C]">Featured Products</h2>
                <p class="text-[#56432C] text-sm">Discover great finds from our community</p>
            </div>
            
            <!-- Products Grid -->
            <div class="rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 md:p-6">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($products as $product)
                                <div class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] scroll-animate" style="animation-delay: {{ $loop->index * 0.1 }}s;">
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
                                                <h3 class="text-xs sm:text-sm md:text-base font-bold text-gray-900 group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 sm:px-2 sm:py-1 bg-[#D9D9D9] rounded text-gray-700">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>
                                            
                                            <p class="text-gray-500 text-[10px] sm:text-xs md:text-sm mt-0.5 sm:mt-1 truncate">
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
                    <x-empty-message message="No active products found." link="{{ route('products.create') }}" />

                    @endif
                </div>
            </div>
        </div>
    </div>
      <!-- Upcycling and Donate Sections -->
<div class="py-16 bg-[#F4F2ED]">
    <div class=" mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Upcycling Section --}}
            <div class="flex flex-col md:flex-row bg-white p-8  shadow-md items-center scroll-animate">
                {{-- Text Content --}}
                <div class="md:w-1/2 md:pr-8 mb-6 md:mb-0">
                    <h2 class="text-3xl font-bold text-[#634600] mb-4 leading-tight">
                        Revamp Your Wardrobe with Upcycling: Discover Sustainable Style <span class="text-yellow-500">✨</span>
                    </h2>
                    <p class="text-[#786126] mb-6 text-lg">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>
                    <a href="#" class="inline-block bg-[#B59F84] text-white px-8 py-3 rounded-md text-lg font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200">
                        Upcycle Now
                    </a>
                </div>
                {{-- Image --}}
                <div class="md:w-1/2">
                    <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="rounded-lg shadow-md w-full h-80 object-cover">
                </div>
            </div>

            {{-- Donate Section --}}
            <div class="flex flex-col md:flex-row bg-white p-8  shadow-md items-center scroll-animate">
                {{-- Image --}}
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="rounded-lg shadow-md w-full h-80 object-cover">
                </div>
                {{-- Text Content --}}
                <div class="md:w-1/2 md:pl-8">
                    <h2 class="text-3xl font-bold text-[#634600] mb-4 leading-tight">
                        Style with a Purpose: Donate Your Pre-Loved Clothes and Create a Sustainable Future <span class="text-yellow-500">😊</span>
                    </h2>
                    <p class="text-[#786126] mb-6 text-lg">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>
                    <a href="#" class="inline-block bg-[#B59F84] text-white px-8 py-3 rounded-md text-lg font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200">
                        Donate Now
                    </a>
                </div>
            </div>

    </div>
</div>

<style>
    /* Animation classes */
    .animate-fade-in-left {
        animation: fadeInLeft 1.2s ease-out;
    }
    
    .animate-fade-in-right {
        animation: fadeInRight 1.2s ease-out;
    }
    
    .scroll-animate {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: opacity, transform;
    }
    
    .scroll-animate.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

    <script>
    // Favorite button functionality
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

    // Improved scroll animation functionality
    function handleScrollAnimation() {
        const elements = document.querySelectorAll('.scroll-animate');
        
        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            
            // Check if element is in viewport (80% up the screen)
            if (rect.top < windowHeight * 0.8) {
                element.classList.add('animate');
            } else {
                // Remove animate class when element goes out of view
                element.classList.remove('animate');
            }
        });
    }

    // Initialize animations on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Run once on load
        handleScrollAnimation();
        
        // Add scroll event listener
        window.addEventListener('scroll', handleScrollAnimation);
        
        // Also run after a short delay to catch any missed elements
        setTimeout(handleScrollAnimation, 100);
    });

    // Fallback: also run on window load
    window.addEventListener('load', handleScrollAnimation);
    </script>
    
    </div>
</x-app-layout>



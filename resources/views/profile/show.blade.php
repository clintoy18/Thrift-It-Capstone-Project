<x-app-layout>
    <!-- Main Container with Dark Mode Support -->
    <div class="py-6 bg-white overflow-hidden dark:bg-gray-900">
        <!-- Responsive Container with Maximum Width -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- ===== PROFILE HEADER SECTION ===== -->
            <!-- Flex container for responsive header layout -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex items-center gap-3">
                    <!-- Dynamic Title based on User Context -->
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 flex items-center">
                        {{ Auth::id() === $user->id ? 'My Products' : $user->fname . "'s Products" }}
                        
                        <!-- Verified User Badge -->
                        @if ($user->is_verified)
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900">
                                <!-- Checkmark Icon for Verification -->
                                <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="none" 
                                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-1 text-xs font-semibold text-green-700 dark:text-green-200">
                                    Verified User
                                </span>
                            </span>
                        @endif
                    </h2>
                </div>
            </div>

            <!-- ===== PROFILE INFORMATION SECTION ===== -->
            <div class="p-6 mb-8">
                <div class="max-w-6x1">
                  <!-- Enhanced Section Title -->
<h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center gap-3">
    <div class="p-2 bg-gradient-to-r from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-800/20 rounded-lg">
        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
    </div>
    Profile Information
</h3>

   <!-- User Profile Card Container -->
   <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        
                        <!-- Background Image Section -->
                        <!-- Hero-style background with gradient overlay -->
                        <div class="relative h-32 bg-center bg-cover"
                            style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/30"></div>
                        </div>

                        <!-- User Info Content Section -->
                        <div class="relative bg-[#E1D5B6] dark:bg-gray-800 px-6 py-5">
                            
                            <!-- User Avatar Container -->
                            <!-- Positioned absolutely to overlap the background section -->
                            <div class="absolute -top-[60px] left-[100px] -translate-x-1/2 w-[100px] h-[100px] 
                                        bg-[#B59F84] dark:bg-gray-700 rounded-full border-4 border-white 
                                        dark:border-gray-800 flex items-center justify-center z-10">
                                <!-- Initials Display -->
                                <span class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-white">
                                    {{ strtoupper(substr($user->fname, 0, 1) . substr($user->lname, 0, 1)) }}
                                </span>
                            </div>

                            <!-- User Details Container -->
                            <div class="flex items-start -top-[10px] justify-between max-w-5xl mx-auto pt-6">
                                <div class="flex-1">
                                    <!-- User Full Name -->
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">
                                        {{ $user->fname }} {{ $user->lname }}
                                    </h3>
                                    
                                    <!-- Rating Display -->
                                    <div class="flex items-center mt-1">
                                        <!-- Star Rating Icons -->
                                        <div class="flex text-yellow-500">
                                            <span>★★★★★</span> <!-- Static 5-star rating -->
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(5)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Report User Section (Visible to other users only) -->
                            @if (Auth::id() !== $user->id)
                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <!-- Report User Link -->
                                    <a href="{{ route('reports.create', $user->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 
                                               dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                        <!-- Warning/Report Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 9v2m0 4h.01M5.455 4.455a2.836 2.836 0 012-1.455h9.09a2.836 2.836 0 012 1.455l3.182 5.455a2.836 2.836 0 010 2.182L18.545 17.09a2.836 2.836 0 01-2 1.455H7.455a2.836 2.836 0 01-2-1.455L2.273 12.09a2.836 2.836 0 010-2.182L5.455 4.455z" />
                                        </svg>
                                        Report User
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons for Other Users -->
                @if (Auth::id() !== $user->id)
                    <div class="mt-6 flex flex-col sm:flex-row gap-4">
                        <!-- Report User Button -->
                        <a href="{{ route('reports.create', $user) }}"
                            class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold 
                                   text-white bg-red-600 rounded-lg shadow hover:bg-red-700 focus:outline-none 
                                   focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            <!-- Warning Triangle Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Report User
                        </a>
                        
                        <!-- Review User Button -->
                        <a href="{{ route('reviews.create', $user) }}"
                            class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold 
                                   text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none 
                                   focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <!-- Review/Star Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Review User
                        </a>
                    </div>
                @endif
            </div>

            <!-- ===== TAB NAVIGATION SECTION ===== -->
            <div class="flex flex-col">
                <!-- Tab Container -->
                <div class="mb-6">
                    <div class="inline-flex rounded-full bg-gray-100 dark:bg-gray-800 p-1">
                        <!-- Products Tab Button -->
                        <button id="tab-products" type="button"
                            class="px-5 py-2 rounded-full bg-[#E1D5B6] text-gray-800 font-semibold 
                                   transition-all duration-300 transform hover:scale-105 active:scale-95 
                                   focus:outline-none focus:ring-2 focus:ring-[#E1D5B6] focus:ring-opacity-50 
                                   shadow-md hover:shadow-lg">
                            Products
                        </button>
                        
                        <!-- Reviews Tab Button -->
                        <button id="tab-reviews" type="button"
                            class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100 
                                   transition-all duration-300 transform hover:scale-105 active:scale-95 
                                   focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50 
                                   hover:bg-gray-200 dark:hover:bg-gray-700">
                            Reviews
                        </button>
                        
                        <!-- Orders Tab Button (Visible to profile owner only) -->
                        @if (Auth::id() === $user->id)
                            <button id="tab-orders" type="button"
                                class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100 
                                       transition-all duration-300 transform hover:scale-105 active:scale-95 
                                       focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50 
                                       hover:bg-gray-200 dark:hover:bg-gray-700">
                                Orders
                            </button>
                        @endif
                    </div>
                </div>

                <!-- ===== PRODUCTS TAB CONTENT ===== -->
                <div id="products" class="overflow-hidden mb-8">

                    <!-- Available Products Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Available Products</h3>
                        
                        @if ($availableProducts->count() > 0)
                            <!-- Products Grid Layout -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($availableProducts as $product)
                                    <!-- Individual Product Card -->
                                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden 
                                                shadow hover:shadow-lg transition duration-200 border 
                                                border-gray-200 dark:border-gray-700">
                                        
                                        <!-- Product Link -->
                                        <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                            
                                            <!-- Donation Badge -->
                                            @if ($product->listingtype === 'for donation')
                                                <div class="absolute top-2 left-2 z-10 bg-yellow-100 
                                                            text-yellow-800 text-xs px-2 py-1 rounded-full 
                                                            font-semibold shadow">
                                                    Donation
                                                </div>
                                            @endif
                                            
                                            <!-- Product Image Container -->
                                            <div class="relative aspect-square overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->first_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover transition-transform 
                                                           duration-300 group-hover:scale-105">
                                                
                                                <!-- Hover Overlay Effect -->
                                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20 
                                                            opacity-0 group-hover:opacity-100 transition-opacity 
                                                            duration-300 flex items-center justify-center">
                                                    <span class="bg-white text-gray-800 px-3 py-1 rounded-full 
                                                                 text-xs font-medium shadow">
                                                        Quick view
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Product Information -->
                                            <div class="p-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <!-- Product Name -->
                                                    <h3 class="text-sm font-bold text-gray-900 dark:text-white 
                                                               group-hover:text-red-600 transition-colors 
                                                               truncate max-w-[70%]">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <!-- Product Size -->
                                                    <span class="text-xs font-medium px-2 py-1 
                                                                bg-gray-100 dark:bg-gray-700 rounded 
                                                                text-gray-700 dark:text-gray-300">
                                                        {{ $product->size ?? 'L' }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Product Category -->
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mb-2 truncate">
                                                    {{ $product->category->name ?? 'No Category' }}
                                                </p>
                                                
                                                <!-- Price and Favorite Button -->
                                                <div class="flex justify-between items-center">
                                                    <!-- Price Display -->
                                                    <p class="text-sm font-bold 
                                                              {{ $product->listingtype === 'for donation' ? 'text-yellow-700' : 'text-red-600' }}">
                                                        {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                    </p>
                                                    
                                                    <!-- Favorite Button -->
                                                    <button class="favorite-btn text-gray-400 hover:text-red-500 
                                                                   focus:outline-none transition-colors"
                                                            data-id="{{ $product->id }}" type="button"
                                                            onclick="event.preventDefault(); event.stopPropagation();">
                                                        <!-- Heart Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State for Available Products -->
                            <x-empty-message message="No active products found." :link="route('products.create')" />
                        @endif
                    </div>

                    <!-- Sold Products Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Sold Products</h3>
                        
                        @if ($soldProducts->count() > 0)
                            <!-- Sold Products Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($soldProducts as $product)
                                    <!-- Sold Product Card (Disabled State) -->
                                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden 
                                                shadow hover:shadow-lg transition duration-200 border 
                                                border-gray-200 dark:border-gray-700">
                                        
                                        <!-- Disabled Link for Sold Items -->
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="block h-full pointer-events-none opacity-70">
                                            
                                            <!-- Sold Badge -->
                                            <div class="absolute top-2 left-2 z-20 bg-red-500 text-white 
                                                        text-xs px-2 py-1 rounded-full font-semibold shadow">
                                                Sold
                                            </div>

                                            <!-- Donation Badge for Sold Items -->
                                            @if ($product->listingtype === 'for donation')
                                                <div class="absolute top-2 right-2 z-10 bg-yellow-100 
                                                            text-yellow-800 text-xs px-2 py-1 rounded-full 
                                                            font-semibold shadow">
                                                    Donation
                                                </div>
                                            @endif

                                            <!-- Product Image with Dimmed Effect -->
                                            <div class="relative aspect-square overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->first_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover transition-transform 
                                                           duration-300 group-hover:scale-105 filter brightness-75">
                                                
                                                <!-- Hover Overlay -->
                                                <div class="absolute inset-0 bg-gray-800 bg-opacity-20 
                                                            opacity-0 group-hover:opacity-100 transition-opacity 
                                                            duration-300 flex items-center justify-center">
                                                    <span class="bg-white text-gray-800 px-3 py-1 rounded-full 
                                                                 text-xs font-medium shadow">
                                                        Quick view
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Product Information -->
                                            <div class="p-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h3 class="text-sm font-bold text-gray-900 dark:text-white 
                                                               group-hover:text-red-600 transition-colors 
                                                               truncate max-w-[70%]">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <span class="text-xs font-medium px-2 py-1 
                                                                bg-gray-100 dark:bg-gray-700 rounded 
                                                                text-gray-700 dark:text-gray-300">
                                                        {{ $product->size ?? 'L' }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mb-2 truncate">
                                                    {{ $product->category->name ?? 'No Category' }}
                                                </p>
                                                <div class="flex justify-between items-center">
                                                    <p class="text-sm font-bold 
                                                              {{ $product->listingtype === 'for donation' ? 'text-yellow-700' : 'text-red-600' }}">
                                                        {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                    </p>
                                                    <!-- Favorite Button -->
                                                    <button class="favorite-btn text-gray-400 hover:text-red-500 
                                                                   focus:outline-none transition-colors"
                                                            data-id="{{ $product->id }}" type="button"
                                                            onclick="event.preventDefault(); event.stopPropagation();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State for Sold Products -->
                            <p class="text-gray-500 dark:text-gray-400">No sold products yet.</p>
                        @endif
                    </div>
                </div>

                <!-- ===== REVIEWS TAB CONTENT ===== -->
                <div id="reviews" class="hidden overflow-hidden mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reviews Received</h3>
                    
                    @forelse($user->reviewsReceived as $review)
                        <!-- Individual Review Card -->
                        <div class="mb-6 p-4 border dark:border-gray-700 rounded-lg 
                                    bg-gray-50 dark:bg-gray-700 shadow-sm">
                            
                            <!-- Review Header -->
                            <div class="flex justify-between items-center mb-2">
                                <!-- Reviewer Name -->
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $review->reviewer->fname ?? 'Anonymous' }}
                                </div>
                                
                                <!-- Star Rating -->
                                <div class="flex space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" 
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.362 4.197a1 1 0 00.95.69h4.417c.969 0 1.371 1.24.588 1.81l-3.58 2.601a1 1 0 00-.364 1.118l1.362 4.197c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.58 2.601c-.784.57-1.838-.197-1.539-1.118l1.362-4.197a1 1 0 00-.364-1.118L2.3 9.624c-.782-.57-.38-1.81.588-1.81h4.418a1 1 0 00.949-.69l1.362-4.197z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            
                            <!-- Review Comment -->
                            @if ($review->comment)
                                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                    {{ $review->comment }}
                                </p>
                            @endif
                            
                            <!-- Review Date -->
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Reviewed on {{ $review->created_at->format('F j, Y') }}
                            </p>
                        </div>
                    @empty
                        <!-- Empty State for Reviews -->
                        <p class="text-gray-500 dark:text-gray-400">No reviews received yet.</p>
                    @endforelse
                </div>

                <!-- ===== ORDERS TAB CONTENT ===== -->
                <div id="orders" class="hidden overflow-hidden mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Orders</h3>

                    @if ($orders->count() > 0)
                        <!-- Orders Table Container -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                                <!-- Table Header -->
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Order ID
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Product
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Buyer
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Status
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Actions
                                        </th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Proof
                                        </th>
                                    </tr>
                                </thead>
                                
                                <!-- Table Body -->
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <!-- Order ID -->
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                #{{ $order->id }}
                                            </td>
                                            
                                            <!-- Product Name -->
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $order->product->name }}
                                            </td>
                                            
                                            <!-- Buyer Name -->
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $order->buyer->fname }}
                                            </td>
                                            
                                            <!-- Order Status Badge -->
                                            <td class="px-4 py-2 text-sm">
                                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'approved') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'delivering') bg-purple-100 text-purple-800
                                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            
                                            <!-- Action Buttons -->
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200 space-x-1">
                                                @if ($order->status === 'pending')
                                                    <!-- Approve Order Form -->
                                                    <form action="{{ route('orders.updateStatus', [$order->id, 'approved']) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-green-600 text-white rounded 
                                                                   hover:bg-green-700 transition-colors">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    
                                                    <!-- Cancel Order Form -->
                                                    <form action="{{ route('orders.updateStatus', [$order->id, 'cancelled']) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-red-600 text-white rounded 
                                                                   hover:bg-red-700 transition-colors">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                    
                                                @elseif($order->status === 'approved')
                                                    <!-- Mark as Delivering Form -->
                                                    <form action="{{ route('orders.updateStatus', [$order->id, 'delivering']) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-blue-600 text-white rounded 
                                                                   hover:bg-blue-700 transition-colors">
                                                            Mark as Delivering
                                                        </button>
                                                    </form>
                                                    
                                                @elseif($order->status === 'delivering')
                                                    <!-- Mark as Completed Form -->
                                                    <form action="{{ route('orders.updateStatus', [$order->id, 'completed']) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-purple-600 text-white rounded 
                                                                   hover:bg-purple-700 transition-colors">
                                                            Mark as Completed
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            
                                            <!-- Proof of Payment Column -->
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                @if ($order->proof)
                                                    <!-- View Proof Button -->
                                                    <button type="button"
                                                        onclick="window.open('{{ asset('storage/' . $order->proof) }}', '_blank')"
                                                        class="px-3 py-1 text-xs bg-indigo-600 text-white rounded 
                                                               hover:bg-indigo-700 transition-colors">
                                                        View Proof
                                                    </button>
                                                @else
                                                    <!-- No Proof Available -->
                                                    <span class="text-gray-500 dark:text-gray-400 text-xs">
                                                        No proof uploaded
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State for Orders -->
                        <p class="text-gray-500 dark:text-gray-400">No orders yet.</p>
                    @endif
                </div>
            </div>

            <!-- ===== STYLES SECTION ===== -->
            <style>
                /* Smooth scrolling for better UX */
                html {
                    scroll-behavior: smooth;
                }

                /* Tab button transitions */
                #tab-products,
                #tab-reviews,
                #tab-orders {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                /* Active tab styling */
                #tab-products.active,
                #tab-reviews.active,
                #tab-orders.active {
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                                0 2px 4px -1px rgba(0, 0, 0, 0.06);
                }

                /* Pulse animation for button clicks */
                @keyframes pulse {
                    0% {
                        transform: scale(1);
                    }
                    50% {
                        transform: scale(0.95);
                    }
                    100% {
                        transform: scale(1);
                    }
                }

                /* Button click animation class */
                .button-click {
                    animation: pulse 0.3s ease-in-out;
                }

                /* Enhanced hover effects for product cards */
                .group:hover .group-hover\:scale-105 {
                    transform: scale(1.05);
                }

                /* Smooth transitions for all interactive elements */
                .transition-all {
                    transition-property: all;
                }
            </style>

            <!-- ===== JAVASCRIPT SECTION ===== -->
            <script>
                (function() {
                    // Tab elements
                    const productsTab = document.getElementById('tab-products');
                    const reviewsTab = document.getElementById('tab-reviews');
                    const ordersTab = document.getElementById('tab-orders');

                    // Content sections
                    const products = document.getElementById('products');
                    const reviews = document.getElementById('reviews');
                    const orders = document.getElementById('orders');

                    /**
                     * Activate specific tab and show corresponding content
                     * @param {string} tab - The tab to activate ('products', 'reviews', 'orders')
                     */
                    function activate(tab) {
                        const isProducts = tab === 'products';
                        const isReviews = tab === 'reviews';
                        const isOrders = tab === 'orders';

                        // Toggle content visibility
                        products.classList.toggle('hidden', !isProducts);
                        reviews.classList.toggle('hidden', !isReviews);
                        orders.classList.toggle('hidden', !isOrders);

                        // Remove active styles from all tabs
                        [productsTab, reviewsTab, ordersTab].forEach(btn => {
                            btn?.classList.remove('bg-[#E1D5B6]', 'font-semibold', 'shadow-md');
                        });

                        // Add active styles to current tab
                        const activeTab = tab === 'products' ? productsTab : 
                                        (tab === 'reviews' ? reviewsTab : ordersTab);
                        activeTab?.classList.add('bg-[#E1D5B6]', 'font-semibold', 'shadow-md');

                        // Smooth scroll to the activated section
                        const target = tab === 'products' ? products : 
                                     (tab === 'reviews' ? reviews : orders);
                        target?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }

                    // Event listeners for tab clicks
                    productsTab?.addEventListener('click', () => activate('products'));
                    reviewsTab?.addEventListener('click', () => activate('reviews'));
                    ordersTab?.addEventListener('click', () => activate('orders'));

                    // Initialize with products tab active
                    activate('products');
                })();
            </script>

</x-app-layout>
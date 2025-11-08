<x-app-layout>
    <!-- Main Container with Dark Mode Support -->
    <div class="py-6 bg-white overflow-hidden dark:bg-gray-900">
        <!-- Responsive Container with Maximum Width -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{}">
            {{--             
            <!-- ===== PROFILE HEADER SECTION ===== -->
            <!-- Flex container for responsive header layout -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex items-center gap-3">
                   <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 flex items-center">
                        <x-user-name-badge :user="$user" :show-full-name="true" />
                    </h2>
                </div>
            </div> --}}

            <!-- ===== PROFILE INFORMATION SECTION ===== -->
            <div class="pb-6 mb-0">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Enhanced Section Title -->
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center gap-3">
                        <div
                            class="p-2 bg-gradient-to-r from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-800/20 rounded-lg">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <x-user-name-badge :user="$user" :show-full-name="true" />'s Profile
                    </h3>
                    <!-- User Profile Card Container -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-32 bg-center bg-cover"
                            style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/30"></div>
                        </div>

                        <!-- User Info Content Section -->
                        <div class="relative bg-[#E1D5B6] dark:bg-gray-800 px-6 py-5">

                            <!-- User Profile Pic Container -->
                            <div
                                class="absolute -top-[60px] left-[100px] -translate-x-1/2 w-[100px] h-[100px]
                rounded-full border-4 border-white dark:border-gray-800 overflow-hidden shadow-lg z-10">
                                @if ($user->profile_pic && Storage::disk('s3')->exists($user->profile_pic))
                                    <img src="{{ Storage::disk('s3')->url($user->profile_pic) }}"
                                        alt="{{ $user->name }}'s Profile Picture" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture"
                                        class="w-full h-full object-cover">
                                @endif

                            </div>

                            <!-- User Details Container -->
                            <div class="max-w-5xl mx-auto pt-6">
                                <div class="flex items-start justify-between">
                                    <!-- User Info Left -->
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">
                                            <x-user-name-badge :user="$user" :show-full-name="true" />
                                        </h3>

                                        <!-- Rating Display -->
                                        <div class="flex items-center mt-1">
                                            <div class="flex text-yellow-500">
                                                <span>★★★★★</span> <!-- Static 5-star rating -->
                                            </div>
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(5)</span>
                                        </div>
                                    </div>

                                    <!-- User Points -->
                                    <div class="text-center">
                                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Eco Points
                                        </span>
                                        <span class="text-5xl font-bold text-[#B59F84] dark:text-yellow-400 block mb-4">
                                            {{ $user->points ?? 0 }}
                                        </span>
                                    </div>
                                </div>
                                <!-- Divider Line -->
                                <div class="border-t border-gray-200 dark:border-gray-600 mt-6 pt-4"></div>

                                <!-- Unified Action Buttons Row -->
                                @if (Auth::id() !== $user->id)
                                    <div class="flex items-center justify-between mt-2">
                                        <!-- Left Side: Report and Review -->
                                        <div class="flex items-center gap-6">
                                            <!-- Report User Button -->
                                            <button type="button"
                                                x-on:click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'report-modal' }))"
                                                class="flex items-center text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 
                       text-sm font-medium transition focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a1 1 0 00.86 1.5h18.64a1 1 0 00.86-1.5L13.71 3.86a1 1 0 00-1.72 0z" />
                                                </svg>
                                                Report User
                                            </button>

                                            <!-- Review User Button -->
                                            <button type="button"
                                                x-on:click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'review-modal' }))"
                                                class="flex items-center text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 
                       text-sm font-medium transition focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                                Review User
                                            </button>
                                        </div>

                                        <!-- Right Side: Message Button -->
                                        <a href="{{ route('private.chat', $user->id) }}"
                                            class="flex items-center gap-2 px-5 py-2 border border-[#5C4033] text-white bg-[#5C4033]
           rounded-md text-sm font-medium hover:bg-[#7A5238]
           dark:border-[#C6A580] dark:bg-[#7A5238] dark:hover:bg-[#8E6542]
           transition duration-300 ease-in-out shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 8.25h9m-9 3h5.25M21 12c0 4.97-4.03 9-9 9-1.5 0-2.91-.36-4.15-1L3 21l1-4.15A8.96 8.96 0 013 12c0-4.97 4.03-9 9-9s9 4.03 9 9z" />
                                            </svg>
                                            Message
                                        </a>

                                    </div>
                                @endif



                            </div>
                        </div>


                        <!-- ===== DASHBOARD SECTION (Only visible to profile owner) ===== -->
                        @if (Auth::id() === $user->id)
                            <div
                                class="mt-12 p-4 sm:p-8 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/10 shadow-lg sm:rounded-lg mb-8 border border-amber-200 dark:border-amber-700">
                                <div class="max-w-full">
                                    @include('profile.partials.dashboard')
                                </div>
                            </div>
                        @endif

                        <!-- ===== TAB NAVIGATION SECTION ===== -->
                        <div class="flex flex-col p-4">
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
                                <!-- Products Header with Stats -->
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h3
                                            class="text-2xl font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                            <svg class="w-6 h-6 text-[#B59F84]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                            Product Inventory
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-2xl">
                                            Manage your sustainable products, track sales performance, and showcase your
                                            eco-friendly creations to potential buyers.
                                        </p>
                                    </div>
                                    <div class="flex gap-4 text-right">
                                        <div>
                                            <div class="text-lg font-bold text-[#B59F84]">
                                                {{ $availableProducts->count() }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Available</div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Available Products Section -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="p-2 bg-[#F1E9D2] dark:bg-[#9C8770] rounded-lg">
                                            <svg class="w-5 h-5 text-[#B59F84] dark:text-[#F1E9D2]" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Available
                                                Products
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Active listings ready
                                                for
                                                purchase or donation</p>
                                        </div>
                                    </div>

                                    @if ($availableProducts->count() > 0)
                                        <!-- Products Grid Layout -->
                                        <div
                                            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                                            @foreach ($availableProducts as $product)
                                                <!-- Individual Product Card -->
                                                <div
                                                    class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="block h-full">
                                                        @if ($product->listingtype === 'for donation')
                                                            <div
                                                                class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                                Donation
                                                            </div>
                                                        @endif
                                                        <div class="relative aspect-square overflow-hidden">
                                                            {{-- S3 BUCKET  fetch image --}}
                                                            <img src="{{ optional($product->images->first())->image
                                                                ? Storage::disk('s3')->url($product->images->first()->image)
                                                                : asset('images/no-image.png') }}"
                                                                alt="Product Image">
                                                            <div
                                                                class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                                <span
                                                                    class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                                    Quick view
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="p-2 sm:p-3">
                                                            <div class="flex justify-between items-start">
                                                                <h3
                                                                    class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white  transition-colors truncate max-w-[70%]">
                                                                    {{ $product->name }}
                                                                </h3>
                                                                <span
                                                                    class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                                    {{ $product->size ?? 'L' }}
                                                                </span>
                                                            </div>

                                                            <p
                                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                                {{ $product->category->name ?? 'No Category' }}
                                                            </p>
                                                            <p
                                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                                <i> {{ $product->barangay->name ?? 'N/A' }}, Cebu
                                                                    City</i>
                                                            </p>

                                                            <div class="flex justify-between items-center mt-1">
                                                                <p
                                                                    class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-black-600' }}">
                                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
                                                                </p>

                                                                <button
                                                                    class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors"
                                                                    data-id="{{ $product->id }}" type="button"
                                                                    onclick="event.preventDefault(); event.stopPropagation();">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
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
                                        <div
                                            class="text-center py-12 bg-[#F8F4EC] dark:bg-gray-700 rounded-2xl border border-[#E9DFC7] dark:border-gray-600">
                                            <div
                                                class="w-16 h-16 bg-white dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                                <svg class="w-8 h-8 text-[#B59F84]" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                    </path>
                                                </svg>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">No
                                                Active Products</h4>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 max-w-md mx-auto">
                                                Start your sustainable journey by listing your first upcycled product!
                                            </p>
                                            <a href="{{ route('products.create') }}"
                                                class="inline-flex items-center bg-[#B59F84] hover:bg-[#9C8770] text-white px-6 py-2 rounded-lg transition-colors gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Create First Product
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Sold Products Section -->
                                <div class="mb-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="p-2 bg-[#F1E9D2] dark:bg-[#8A7560] rounded-lg">
                                            <svg class="w-5 h-5 text-[#8A7560] dark:text-[#F1E9D2]" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Sold Products
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Your successful sales
                                                and
                                                donations history</p>
                                        </div>
                                    </div>

                                    @if ($soldProducts->count() > 0)
                                        <!-- Sold Products Grid -->
                                        <div
                                            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                                            @foreach ($soldProducts as $product)
                                                <!-- Sold Product Card (Disabled State) -->
                                                <div
                                                    class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700 opacity-70">
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="block h-full">
                                                        <!-- Sold Badge -->
                                                        <div
                                                            class="absolute top-1 left-1 z-20 bg-[#8A7560] text-white text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full font-semibold">
                                                            Sold
                                                        </div>

                                                        @if ($product->listingtype === 'for donation')
                                                            <div
                                                                class="absolute top-1 right-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                                Donation
                                                            </div>
                                                        @endif
                                                        <div class="relative aspect-square overflow-hidden">
                                                            {{-- S3 BUCKET  fetch image --}}
                                                            <img src="{{ optional($profil->images->first())->image
                                                                ? Storage::disk('s3')->url($product->images->first()->image)
                                                                : asset('images/no-image.png') }}"
                                                                alt="Product Image">
                                                            <div
                                                                class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                                <span
                                                                    class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                                    View Archive
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="p-2 sm:p-3">
                                                            <div class="flex justify-between items-start">
                                                                <h3
                                                                    class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white  transition-colors truncate max-w-[70%]">
                                                                    {{ $product->name }}
                                                                </h3>
                                                                <span
                                                                    class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                                    {{ $product->size ?? 'L' }}
                                                                </span>
                                                            </div>

                                                            <p
                                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                                {{ $product->category->name ?? 'No Category' }}
                                                            </p>
                                                            <p
                                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                                <i> {{ $product->barangay->name ?? 'N/A' }}, Cebu
                                                                    City</i>
                                                            </p>

                                                            <div class="flex justify-between items-center mt-1">
                                                                <p
                                                                    class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-black-600' }}">
                                                                    {{ $product->listingtype === 'for donation' ? 'Donated' : '₱' . number_format($product->price, 2) }}
                                                                </p>

                                                                <button
                                                                    class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors"
                                                                    data-id="{{ $product->id }}" type="button"
                                                                    onclick="event.preventDefault(); event.stopPropagation();">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
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
                                        <div
                                            class="text-center py-8 bg-[#F8F4EC] dark:bg-gray-700 rounded-xl border border-[#E9DFC7] dark:border-gray-600">
                                            <div
                                                class="w-12 h-12 bg-white dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <svg class="w-6 h-6 text-[#B59F84]" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-1">No
                                                Sales Yet</h4>
                                            <p class="text-gray-600 dark:text-gray-400 text-xs">Your sold products will
                                                appear here</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- ===== REVIEWS TAB CONTENT ===== -->
                            <div id="reviews" class="hidden overflow-hidden mb-8">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reviews Received
                                </h3>

                                @forelse($user->reviewsReceived as $review)
                                    <!-- Individual Review Card -->
                                    <div
                                        class="mb-6 p-4 border dark:border-gray-700 rounded-lg 
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
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.362 4.197a1 1 0 00.95.69h4.417c.969 0 1.371 1.24.588 1.81l-3.58 2.601a1 1 0 00-.364 1.118l1.362 4.197c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.58 2.601c-.784.57-1.838-.197-1.539-1.118l1.362-4.197a1 1 0 00-.364-1.118L2.3 9.624c-.782-.57-.38-1.81.588-1.81h4.418a1 1 0 00.949-.69l1.362-4.197z" />
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
                                <!-- Header with Description -->
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h3
                                            class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2 flex items-center gap-2">
                                            <svg class="w-6 h-6 text-[#B59F84]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            Order Management
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-2xl">
                                            Manage your customer orders, track order status, and update delivery
                                            progress.
                                            Review payment proofs and ensure smooth order fulfillment.
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-[#B59F84]">{{ $orders->count() }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Orders</div>
                                    </div>
                                </div>

                                @if ($orders->count() > 0)
                                    <!-- Orders Table Container -->
                                    <div
                                        class="overflow-x-auto border border-[#E9DFC7] dark:border-gray-700 rounded-lg">
                                        <table class="min-w-full">
                                            <!-- Table Header -->
                                            <thead class="bg-[#F8F4EC] dark:bg-gray-700">
                                                <tr>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                                </path>
                                                            </svg>
                                                            Order ID
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                                </path>
                                                            </svg>
                                                            Product
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                </path>
                                                            </svg>
                                                            Buyer
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                </path>
                                                            </svg>
                                                            Status
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                </path>
                                                            </svg>
                                                            Actions
                                                        </div>
                                                    </th>
                                                    <th
                                                        class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                            Payment Proof
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <!-- Table Body -->
                                            <tbody class="divide-y divide-[#E9DFC7] dark:divide-gray-600">
                                                @foreach ($orders as $order)
                                                    <tr
                                                        class="hover:bg-[#F8F4EC] dark:hover:bg-gray-700 transition-colors">
                                                        <!-- Order ID -->
                                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                                    </path>
                                                                </svg>
                                                                #{{ $order->id }}
                                                            </div>
                                                        </td>

                                                        <!-- Product Name -->
                                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                                    </path>
                                                                </svg>
                                                                {{ $order->product->name }}
                                                            </div>
                                                        </td>

                                                        <!-- Buyer Name -->
                                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                            <div class="flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                                    </path>
                                                                </svg>
                                                                {{ $order->buyer->fname }}
                                                            </div>
                                                        </td>

                                                        <!-- Order Status Badge -->
                                                        <td class="px-4 py-3 text-sm">
                                                            <div class="flex items-center gap-2">
                                                                @if ($order->status === 'pending')
                                                                    <svg class="w-4 h-4 text-[#8A7560]" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                        </path>
                                                                    </svg>
                                                                @elseif($order->status === 'approved')
                                                                    <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M5 13l4 4L19 7"></path>
                                                                    </svg>
                                                                @elseif($order->status === 'delivering')
                                                                    <svg class="w-4 h-4 text-[#6B5B48]" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                                        </path>
                                                                    </svg>
                                                                @elseif($order->status === 'completed')
                                                                    <svg class="w-4 h-4 text-[#B59F84]" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                        </path>
                                                                    </svg>
                                                                @endif
                                                                <span
                                                                    class="px-2 py-1 rounded-full text-xs font-medium
                                        @if ($order->status === 'pending') bg-[#F1E9D2] text-[#8A7560]
                                        @elseif($order->status === 'approved') bg-[#F8F4EC] text-[#B59F84]
                                        @elseif($order->status === 'delivering') bg-[#E1D5B6] text-[#6B5B48]
                                        @elseif($order->status === 'completed') bg-[#F8F4EC] text-[#B59F84]
                                        @else bg-[#F4F2ED] text-[#8A7560] @endif">
                                                                    {{ ucfirst($order->status) }}
                                                                </span>
                                                            </div>
                                                        </td>

                                                        <!-- Action Buttons -->
                                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                            <div class="flex flex-wrap gap-1">
                                                                @if ($order->status === 'pending')
                                                                    <!-- Approve Order Form -->
                                                                    <form
                                                                        action="{{ route('orders.updateStatus', [$order->id, 'approved']) }}"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 text-xs bg-[#B59F84] text-white rounded 
                                                       hover:bg-[#9C8770] transition-colors gap-1">
                                                                            <svg class="w-3 h-3" fill="none"
                                                                                stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M5 13l4 4L19 7">
                                                                                </path>
                                                                            </svg>
                                                                            Approve
                                                                        </button>
                                                                    </form>

                                                                    <!-- Cancel Order Form -->
                                                                    <form
                                                                        action="{{ route('orders.updateStatus', [$order->id, 'cancelled']) }}"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 text-xs bg-[#8A7560] text-white rounded 
                                                       hover:bg-[#6B5B48] transition-colors gap-1">
                                                                            <svg class="w-3 h-3" fill="none"
                                                                                stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M6 18L18 6M6 6l12 12"></path>
                                                                            </svg>
                                                                            Cancel
                                                                        </button>
                                                                    </form>
                                                                @elseif($order->status === 'approved')
                                                                    <!-- Mark as Delivering Form -->
                                                                    <form
                                                                        action="{{ route('orders.updateStatus', [$order->id, 'delivering']) }}"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 text-xs bg-[#B59F84] text-white rounded 
                                                       hover:bg-[#9C8770] transition-colors gap-1">
                                                                            <svg class="w-3 h-3" fill="none"
                                                                                stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                                                </path>
                                                                            </svg>
                                                                            Shipping
                                                                        </button>
                                                                    </form>
                                                                @elseif($order->status === 'delivering')
                                                                    <!-- Mark as Completed Form -->
                                                                    <form
                                                                        action="{{ route('orders.updateStatus', [$order->id, 'completed']) }}"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 text-xs bg-[#9C8770] text-white rounded 
                                                       hover:bg-[#8A7560] transition-colors gap-1">
                                                                            <svg class="w-3 h-3" fill="none"
                                                                                stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                                </path>
                                                                            </svg>
                                                                            Complete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>

                                                        <!-- Proof of Payment Column -->
                                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                                            @if ($order->proof)
                                                                <!-- View Proof Button -->
                                                                <button type="button"
                                                                    onclick="window.open('{{ asset('storage/' . $order->proof) }}', '_blank')"
                                                                    class="inline-flex items-center px-3 py-1 text-xs bg-[#B59F84] text-white rounded 
                                               hover:bg-[#9C8770] transition-colors gap-1">
                                                                    <svg class="w-3 h-3" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                        </path>
                                                                    </svg>
                                                                    View Proof
                                                                </button>
                                                            @else
                                                                <!-- No Proof Available -->
                                                                <div
                                                                    class="flex items-center gap-1 text-gray-500 dark:text-gray-400 text-xs">
                                                                    <svg class="w-3 h-3" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                                        </path>
                                                                    </svg>
                                                                    No proof uploaded
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <!-- Empty State for Orders -->
                                    <div class="text-center py-12">
                                        <div
                                            class="w-16 h-16 bg-[#F8F4EC] dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-[#B59F84]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">No
                                            Orders
                                            Yet</h4>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm max-w-md mx-auto">
                                            Your order dashboard is ready! When customers place orders, they will appear
                                            here for you to manage.
                                        </p>
                                    </div>
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

                        <!-- Modals: single instances on the page -->
                        <x-review-modal :user="$user" />
                        <x-report-modal :user="$user" />

</x-app-layout>

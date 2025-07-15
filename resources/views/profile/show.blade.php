<x-app-layout>
    <div class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-red-600 dark:text-red-400">
                    {{ Auth::id() === $user->id ? 'My Products' : $user->fname . "'s Products" }}
                </h2>

                @if (Auth::id() === $user->id)
                    <!-- Show button only if current user is viewing their own profile -->
                    <a href="{{ route('products.create') }}" class="px-4 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] hover:scale-105 focus:outline-none transition-all duration-200">
                        <span class="font-semibold">List a Product</span>
                    </a>
                @endif
            </div>
            
               <!-- Profile Information Section -->
               <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h3>

                    <!-- Display User Information -->
                    <div class="mt-2">
                        <p><strong>Name:</strong> {{ $user->fname }}  {{ $user->lname }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</p>
                        
                        @if (Auth::id() !== $user->id)
                        <div class="mt-4 space-y-4">
                            <!-- Report User Button -->
                            <a href="{{ route('reports.create', $user) }}" 
                               class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Report User
                            </a>
                    
                            <!-- Review User Button -->
                            <a href="{{ route('reviews.create', $user) }}" 
                               class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Review User
                            </a>
                        </div>
                    @endif
                    
                        
                    </div>
                </div>
            </div>

            <div class="rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 sm:p-6">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($products as $product)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                        @if($product->listingtype === 'for donation')
                                            <div class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif

                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                                                alt="{{ $product->name }}" 
                                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                                            <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                    Quick view
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-2 sm:p-3">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>

                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                {{ $product->category->name ?? 'No Category' }}
                                            </p>

                                            <div class="flex justify-between items-center mt-1">
                                                <p class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-red-600' }}">
                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                </p>
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
                        <x-empty-message message="No active products found." :link="route('products.create')" />
                    @endif
                </div>
            </div>

            <!-- Reviews Received -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reviews Received</h3>

                @forelse($user->reviewsReceived as $review)
                    <div class="mb-4 p-4 border dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700">
                        <div class="flex justify-between items-center mb-1">
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                {{ $review->reviewer->fname ?? 'Anonymous' }}
                            </div>
                            <div class="flex space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.362 4.197a1 1 0 00.95.69h4.417c.969 0 1.371 1.24.588 1.81l-3.58 2.601a1 1 0 00-.364 1.118l1.362 4.197c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.58 2.601c-.784.57-1.838-.197-1.539-1.118l1.362-4.197a1 1 0 00-.364-1.118L2.3 9.624c-.782-.57-.38-1.81.588-1.81h4.418a1 1 0 00.949-.69l1.362-4.197z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        @if($review->comment)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                {{ $review->comment }}
                            </p>
                        @endif

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Reviewed on {{ $review->created_at->format('F j, Y') }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No reviews received yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>

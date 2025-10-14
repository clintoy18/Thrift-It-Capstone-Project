<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Search results for ') }} &nbsp;"{{ request('query') }}"
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white dark:bg-gray-900 overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                @if(request('query'))
                    <!-- Product Search Results -->
                    @if($products->count() > 0)
                        <div class="flex items-baseline justify-between">
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Products</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Showing {{ $products->count() }} of {{ method_exists($products, 'total') ? $products->total() : $products->count() }} results</p>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6 mt-6">
                            @foreach ($products as $product)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                        @if($product->listingtype === 'for donation')
                                            <div class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif
                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ asset('storage/' . ($product->first_image ?? ($product->image ?? ''))) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                    Quick view
                                                </span>
                                            </div>
                                        </div>
                                        <div class="p-2 sm:p-3">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>
                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                {{ $product->category->name ?? 'No Category' }}
                                            </p>
                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                              <i>  {{ $product->barangay->name ?? 'N/A' }}, Cebu City</i>
                                            </p>
                                            <div class="flex justify-between items-center mt-1">
                                                <p class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-black-600' }}">
                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
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
                        <div class="mt-6">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-gray-300 dark:border-gray-700 p-10 text-center">
                            <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M21 19l-5.2-5.2a6.5 6.5 0 10-2 2L19 21l2-2zM5 10.5a5.5 5.5 0 1111 0 5.5 5.5 0 01-11 0z"/></svg>
                            </div>
                            <h4 class="mt-3 text-base font-semibold text-gray-900 dark:text-gray-100">No products found</h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No products match "<strong>{{ request('query') }}</strong>". Try different keywords.</p>
                        </div>
                    @endif

                    <!-- User Search Results -->
                    @if($users->count() > 0)
                        <h3 class="mt-10 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Users</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                            @foreach ($users as $user)
                                <a href="{{ route('profile.show', $user->id) }}" class="block bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200/70 dark:border-gray-700/60 shadow-sm hover:shadow-xl transition duration-300 ease-out hover:-translate-y-1">
                                    <div class="p-5">
                                        <!-- Profile Picture -->
                                        <div class="w-16 h-16 rounded-full overflow-hidden border border-gray-200 dark:border-gray-600 mb-3">
                                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- User Info -->
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm truncate">{{ $user->email }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 text-center">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    @else
                        {{-- Hide the empty users state when products exist to avoid confusion --}}
                        @if($products->count() === 0)
                            <div class="mt-10 rounded-xl border border-dashed border-gray-300 dark:border-gray-700 p-10 text-center">
                                <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 110-10 5 5 0 010 10zm-9 9a9 9 0 1118 0H3z"/></svg>
                                </div>
                                <h4 class="mt-3 text-base font-semibold text-gray-900 dark:text-gray-100">No users found</h4>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No users match "<strong>{{ request('query') }}</strong>". Try different keywords.</p>
                            </div>
                        @endif
                    @endif
                @else
                    <div class="rounded-xl border border-dashed border-gray-300 dark:border-gray-700 p-10 text-center">
                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100">Start your search</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Please enter a search query to see matching results.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.textContent = this.textContent === '🤍' ? '❤️' : '🤍';
                this.classList.toggle('text-red-500');
            });
        });
    </script>
</x-app-layout>

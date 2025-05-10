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
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden sm:rounded-md p-6">
                @if(request('query'))
                    <!-- Product Search Results -->
                    @if($products->count() > 0)
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Products</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                            @foreach ($products as $product)
                                <a href="{{ route('products.show', $product->id) }}" class="block bg-white text-black rounded-lg overflow-hidden shadow-lg border border-gray-200 hover:shadow-xl transition duration-200 ease-in-out transform hover:scale-105">
                                    <div class="relative group">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" alt="{{ $product->name }}" class="w-full h-64 object-cover border-2 border-transparent group-hover:border-blue-500 transition">
                                    </div>

                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                                            <span class="text-gray-600 font-semibold">{{ $product->size ?? 'L' }}</span>
                                        </div>
                                        <p class="text-gray-500 text-sm truncate">{{ $product->category->name ?? 'No Category' }}</p>
                                        <div class="flex justify-between items-center mt-2">
                                            <p class="text-black font-bold text-lg">
                                                {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
                                            </p>
                                            <button class="favorite-btn text-gray-500 hover:text-red-500" aria-label="Favorite Product" data-id="{{ $product->id }}" onclick="event.preventDefault();">
                                                🤍
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    @else
                        <p class="text-gray-400 text-center">No products found matching "<strong>{{ request('query') }}</strong>".</p>
                    @endif

                    <!-- User Search Results -->
                    @if($users->count() > 0)
                        <h3 class="mt-8 text-2xl font-semibold text-gray-900 dark:text-gray-100">Users</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                            @foreach ($users as $user)
                                <a href="{{ route('profile.show', $user->id) }}" class="block bg-white text-black rounded-lg overflow-hidden shadow-md border border-gray-200 hover:shadow-xl transition duration-200 ease-in-out transform hover:scale-105">
                                    <div class="relative p-4">
                                        <!-- Profile Picture -->
                                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-gray-300 mb-4">
                                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- User Info -->
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $user->name }}</h3>
                                        <p class="text-gray-600 text-sm truncate">{{ $user->email }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 text-center">
                            {{ $users->links('pagination::tailwind') }}
                        </div>
                    @else
                        <div class="mt-8 text-center text-gray-500">
                            <p class="text-lg">No users found matching "<strong>{{ request('query') }}</strong>".</p>
                            <p class="mt-4">Try searching with different keywords or browse other results.</p>
                        </div>
                    @endif
                @else
                    <p class="text-gray-400 text-center">Please enter a search query.</p>
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

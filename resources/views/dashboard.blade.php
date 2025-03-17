<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden sm:rounded-md p-6">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <a href="{{ route('products.show', $product->id) }}" class="block bg-white text-black rounded-lg overflow-hidden shadow-lg border border-gray-200 hover:shadow-xl transition duration-200 ease-in-out">
                                <!-- Image with border highlight -->  
                                <div class="relative group">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-64 object-cover border-2 border-transparent group-hover:border-blue-500 transition">
                                </div>

                                <!-- Product Details -->  
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                                        <span class="text-gray-600 font-semibold">{{ $product->size ?? 'L' }}</span>
                                    </div>
                                    <p class="text-gray-500 text-sm truncate">{{ $product->category->name ?? 'No Category' }}</p>
                                    
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-black font-bold text-lg">
                                            {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                        </p>
                                        <button class="favorite-btn text-gray-500 hover:text-red-500" data-id="{{ $product->id }}" onclick="event.preventDefault();">
                                            🤍
                                        </button>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-center">No products available.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle the favorite icon (for demonstration purposes only)
                this.textContent = this.textContent === '🤍' ? '❤️' : '🤍';
            });
        });
    </script>



</x-app-layout>

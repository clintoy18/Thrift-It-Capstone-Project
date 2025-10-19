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
                        <img 
                            src="{{ asset('storage/' . ($product->first_image ?? 'images/default-placeholder.png')) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                Quick view
                            </span>
                        </div>
                    </div>
                    <div class="p-2 sm:p-3">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white group-hover:text-gray-700 transition-colors truncate max-w-[70%]">
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
                            <p class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-gray-800 dark:text-gray-200' }}">
                                {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@else
    <x-empty-message message="No products found in this segment." link="{{ route('products.create') }}" />
@endif



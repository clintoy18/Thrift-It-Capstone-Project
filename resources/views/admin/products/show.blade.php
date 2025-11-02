<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Product Overview Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                 <!-- Swiper Slider -->
                    <div class="relative swiper mySwiper rounded-xl overflow-hidden shadow-lg h-[28rem] sm:h-[32rem]">
                        <div class="swiper-wrapper h-full">
                            @if ($product->images && $product->images->count() > 0)
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide flex items-center justify-center bg-white h-full">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-105">
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback placeholder if no images -->
                                <div class="swiper-slide flex items-center justify-center bg-white h-full">
                                    <img src="{{ asset('images/default-placeholder.png') }}" alt="No image"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                        </div>

                        <!-- Swiper Pagination (overlay) -->
                        <div class="swiper-pagination absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10"></div>
                        <!-- Swiper Navigation -->
                        <div
                            class="swiper-button-next !text-white text-3xl z-20 hover:!text-gray-200 transition-colors duration-300">
                        </div>
                        <div
                            class="swiper-button-prev !text-white text-3xl z-20 hover:!text-gray-200 transition-colors duration-300">
                        </div>
                    </div>
                {{-- Product Details --}}
                <div class="col-span-1 lg:col-span-2 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <span class="px-3 py-1 text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-y-4 text-gray-700 dark:text-gray-300">
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Price:</span>
                            <span class="ml-1 text-green-600 dark:text-green-400 font-semibold">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        </p>
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Created on:</span>
                            <span class="ml-1">{{ $product->created_at->format('F j, Y, g:i A') }}</span>
                        </p>
                    </div>

                    @if($product->description)
                        <div class="mt-6">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Description</h4>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $product->description }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Seller Information --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Seller Information</h3>
                </div>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                    <p>
                        <span class="font-medium text-gray-900 dark:text-gray-100">Name:</span>
                        {{ $product->user->fname ?? $product->user->first_name }}
                        {{ $product->user->lname ?? $product->user->last_name }}
                    </p>
                    <p>
                        <span class="font-medium text-gray-900 dark:text-gray-100">Email:</span>
                        {{ $product->user->email }}
                    </p>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Comments</h3>

                @forelse($product->comments as $comment)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4 last:border-none last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $comment->user->fname ?? $comment->user->first_name }}
                                    {{ $comment->user->lname ?? $comment->user->last_name }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $comment->created_at->format('M d, Y g:i A') }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $comment->content }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                        <p>No comments yet</p>
                        <p class="text-sm mt-1">Be the first to share your thoughts about this product.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>

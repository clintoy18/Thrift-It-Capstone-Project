<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
            <a href="{{ route('admin.products.edit', $product) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow">
                    Edit Product
                </a>
            </div>
            <!-- Product & Seller Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Product Image -->
                <div class="col-span-1">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-300 dark:border-gray-600">
                </div>

                <!-- Product Details -->
                <div class="col-span-1 lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Product Information</h3>
                    <div class="grid sm:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                        <p><span class="font-semibold">Name:</span> {{ $product->name }}</p>
                        <p><span class="font-semibold">Price:</span> ${{ number_format($product->price, 2) }}</p>
                        <p><span class="font-semibold">Category:</span> {{ $product->category->name }}</p>
                        <p><span class="font-semibold">Created:</span> {{ $product->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Seller Info -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Seller Information</h3>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                    <p><span class="font-semibold">Name:</span> {{ $product->user->fname }} {{ $product->user->lname }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $product->user->email }}</p>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Description</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Comments -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Comments</h3>
                @forelse($product->comments as $comment)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $comment->created_at->format('M d, Y g:i A') }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No comments yet</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

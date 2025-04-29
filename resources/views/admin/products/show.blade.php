<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Product Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Product Details</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $product->name }}</p>
                                <p><span class="font-medium">Price:</span> ${{ number_format($product->price, 2) }}</p>
                                <p><span class="font-medium">Category:</span> {{ $product->category->name }}</p>
                                <p><span class="font-medium">Created:</span> {{ $product->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Seller Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $product->user->first_name }} {{ $product->user->last_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $product->user->email }}</p>
                                <p><span class="font-medium">Role:</span> {{ $product->user->role->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Description</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ $product->description }}</p>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Comments</h3>
                        <div class="space-y-4">
                            @forelse($product->comments as $comment)
                                <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('M d, Y g:i A') }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">No comments yet</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Update Form -->
                    <div class="mt-6">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="pending" {{ $product->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="rejected" {{ $product->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Admin Notes</label>
                                    <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">{{ $product->admin_notes }}</textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
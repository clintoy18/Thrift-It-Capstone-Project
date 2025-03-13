<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
            </h2>
            <a href="{{ route('products.create') }}" class="ml-auto bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Create Product</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-gray-900 text-white rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('default-image.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover">

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-400">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p class="text-teal-400 font-bold">₱{{ number_format($product->price, 2) }}</p>

                                    <div class="flex justify-between mt-4">
                                        <a href="{{ route('products.edit', $product) }}" 
                                           class="text-yellow-400 hover:text-yellow-300">
                                            ✏️ Edit
                                        </a>
                                        
                                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400" onclick="return confirm('Are you sure?')">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-center">No products available.</p>
                @endif
            </div>
        </div>
    </div>  
</x-app-layout>

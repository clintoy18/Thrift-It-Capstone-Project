<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold text-red-600 mb-4">
            {{ $segment->name }} – Products
        </h1>

        @if($products->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                            <div class="p-3">
                                <h3 class="text-sm font-semibold text-gray-900">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $product->category->name ?? '' }}</p>
                                <div class="mt-1 text-red-600 font-bold text-sm">
                                    ₱{{ number_format($product->price, 2) }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products available in this segment yet.</p>
        @endif
    </div>
</x-app-layout>

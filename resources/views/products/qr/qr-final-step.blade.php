<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Finalize Product') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- ✅ Step Progress -->
            <x-step-progress :current-step="3" />

            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Review and finalize your product
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Please check your product details before submitting.
                </p>

                <!-- Product Preview -->
                <div class="mb-6 space-y-3">
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
                    <p><strong>Segment:</strong> {{ $product->segment->name ?? '-' }}</p>
                    <p><strong>Barangay:</strong> {{ $product->barangay->name ?? '-' }}</p>

                    @if($product->qr_code)
                        <p><strong>QR Code:</strong></p>
                        <img src="{{ asset('storage/' . $product->qr_code) }}" alt="QR Code" class="w-32 h-32 object-contain border rounded-md">
                    @else
                        <p><strong>QR Code:</strong> Not uploaded</p>
                    @endif
                </div>

                <form action="{{ route('sell-item.finalize', $product->id) }}" method="POST">
                    @csrf
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('sell-item.qr', $product->id) }}"
                           class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 rounded-lg transition-all duration-300">
                           Back to QR Upload
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 bg-[#E1D5B6] hover:bg-[#D5C39A] text-gray-800 font-semibold rounded-lg transition-all duration-300">
                            Finalize Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

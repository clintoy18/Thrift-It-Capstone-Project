<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Product Name -->
                    <div>
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                            :value="old('name', $product->name)" required autofocus />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="block w-full mt-1 p-2 border rounded">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                  <!-- Segment -->
                    <div class="mt-4">
                        <x-input-label for="segment_id" :value="__('Segment')" />
                        <select name="segment_id" id="segment_id" class="block w-full mt-1 p-2 border rounded" required>
                            <option value="" disabled {{ old('segment_id', $product->segment_id ?? '') === '' ? 'selected' : '' }}>Select a segment</option>
                            @foreach ($segments as $segment)
                                <option value="{{ $segment->id }}" {{ old('segment_id', $product->segment_id ?? '') == $segment->id ? 'selected' : '' }}>
                                    {{ ucfirst($segment->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('segment_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Barangay -->
                    <div class="mt-4">
                        <x-input-label for="barangay_id" :value="__('Barangay')" />
                        <select name="barangay_id" id="barangay_id" class="block w-full mt-1 p-2 border rounded" required>
                            <option value="" disabled {{ old('barangay_id', $product->barangay_id ?? '') === '' ? 'selected' : '' }}>Select a barangay</option>
                            @foreach ($barangays as $barangay)
                                <option value="{{ $barangay->id }}" {{ old('barangay_id', $product->barangay_id ?? '') == $barangay->id ? 'selected' : '' }}>
                                    {{ ucfirst($barangay->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('barangay_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" 
                            :value="old('price', $product->price)" required />
                    </div>
                  <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                                <option value="available"
                                    @if($product->status === 'sold') disabled @endif
                                    {{ old('status', $product->status) === 'available' ? 'selected' : '' }}>
                                    Available
                                </option>
                                <option value="sold" {{ old('status', $product->status) === 'sold' ? 'selected' : '' }}>
                                    Sold
                                </option>
                            </select>
                            @if($product->status === 'sold')
                                <p class="text-sm text-red-600 mt-1">Product is sold and cannot be marked as available again.</p>
                            @endif
                        </div>


                    <!-- Image Upload -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Product Image')" />
                        <input type="file" name="image" id="image" class="block w-full mt-1 p-2 border rounded">
                        @if ($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-32 h-32 object-cover">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Update Product') }}</x-primary-button>
                        <a href="{{ route('products.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
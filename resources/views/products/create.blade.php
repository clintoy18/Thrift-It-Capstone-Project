<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List an Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Image Upload Section -->
                    <div class="mb-4">
                        <label class="block text-black font-medium mb-2">Upload Image (JPEG or PNG)</label>
                        <div class="border-2 border-dashed border-gray-400 rounded-lg flex items-center justify-center h-32 relative mb-4">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" required>
                            <span class="text-gray-500">Upload Image</span>
                        </div>
                        @error('image')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-black font-medium mb-2">Description</label>
                        <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg placeholder-gray-500 focus:ring-2 focus:ring-gray-500" placeholder="Enter description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="category_id" class="block text-black font-medium mb-2">Category</label>
                            <select id="category_id" name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="block text-black font-medium mb-2">Item Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" placeholder="Enter item name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="condition" class="block text-black font-medium mb-2">Condition</label>
                            <select id="condition" name="condition" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                                <option value="new">New</option>
                                <option value="used">Used</option>
                            </select>
                            @error('condition')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="size" class="block text-black font-medium mb-2">Size</label>
                            <select id="size" name="size" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                                <option value="">Select size</option>
                                <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                <option value="3XL" {{ old('size') == '3XL' ? 'selected' : '' }}>3XL</option>
                                <option value="4XL" {{ old('size') == '4XL' ? 'selected' : '' }}>4XL</option>
                                <option value="5XL" {{ old('size') == '5XL' ? 'selected' : '' }}>5XL</option>
                            </select>
                            @error('size')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="listingtype" class="block text-black font-medium mb-2">Listing Type</label>
                            <select id="listingtype" name="listingtype" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required onchange="togglePriceField()">
                                <option value="for sale" {{ old('listingtype') == 'for sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="for donation" {{ old('listingtype') == 'for donation' ? 'selected' : '' }}>For Donation</option>
                            </select>
                            @error('listingtype')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status" class="block text-black font-medium mb-2">Status</label>
                            <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Item Price -->
                    <div class="mb-4" id="price-field">
                        <label for="price" class="block text-black font-medium mb-2">Item Price</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" placeholder="Enter price" min="0">
                        @error('price')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-black text-white font-medium py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePriceField() {
            const listingType = document.getElementById('listingtype').value;
            const priceField = document.getElementById('price-field');
            const priceInput = document.getElementById('price');
            if (listingType === 'for donation') {
                priceField.style.display = 'none';
                priceInput.removeAttribute('required');
            } else {
                priceField.style.display = 'block';
                priceInput.setAttribute('required', 'required');
            }
        }
        document.addEventListener('DOMContentLoaded', togglePriceField);
    </script>
</x-app-layout>

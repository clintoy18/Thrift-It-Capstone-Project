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
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Image Upload Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product Image</h3>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6">
                                <div class="flex flex-col items-center justify-center space-y-4 relative">
                                    <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" required onchange="previewImage(this)">
                                    <div id="imagePreview" class="hidden">
                                        <img id="preview" class="max-h-48 w-auto object-contain rounded-lg" src="" alt="Preview">
                                    </div>
                                    <div id="uploadText" class="text-center z-0">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter item name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter detailed description" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="condition" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condition</label>
                                    <select id="condition" name="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                    </select>
                                    @error('condition')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Size</label>
                                    <select id="size" name="size" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="">Select size</option>
                                        <!-- Clothing Sizes -->
                                        <optgroup label="Clothing" class="clothing-sizes hidden">
                                            <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            <option value="3XL" {{ old('size') == '3XL' ? 'selected' : '' }}>3XL</option>
                                            <option value="4XL" {{ old('size') == '4XL' ? 'selected' : '' }}>4XL</option>
                                            <option value="5XL" {{ old('size') == '5XL' ? 'selected' : '' }}>5XL</option>
                                        </optgroup>
                                        <!-- Shoe Sizes -->
                                        <optgroup label="Shoes" class="shoe-sizes hidden">
                                            <option value="4" {{ old('size') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="4.5" {{ old('size') == '4.5' ? 'selected' : '' }}>4.5</option>
                                            <option value="5" {{ old('size') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="5.5" {{ old('size') == '5.5' ? 'selected' : '' }}>5.5</option>
                                            <option value="6" {{ old('size') == '6' ? 'selected' : '' }}>6</option>
                                            <option value="6.5" {{ old('size') == '6.5' ? 'selected' : '' }}>6.5</option>
                                            <option value="7" {{ old('size') == '7' ? 'selected' : '' }}>7</option>
                                            <option value="7.5" {{ old('size') == '7.5' ? 'selected' : '' }}>7.5</option>
                                            <option value="8" {{ old('size') == '8' ? 'selected' : '' }}>8</option>
                                            <option value="8.5" {{ old('size') == '8.5' ? 'selected' : '' }}>8.5</option>
                                            <option value="9" {{ old('size') == '9' ? 'selected' : '' }}>9</option>
                                            <option value="9.5" {{ old('size') == '9.5' ? 'selected' : '' }}>9.5</option>
                                            <option value="10" {{ old('size') == '10' ? 'selected' : '' }}>10</option>
                                            <option value="10.5" {{ old('size') == '10.5' ? 'selected' : '' }}>10.5</option>
                                            <option value="11" {{ old('size') == '11' ? 'selected' : '' }}>11</option>
                                            <option value="11.5" {{ old('size') == '11.5' ? 'selected' : '' }}>11.5</option>
                                            <option value="12" {{ old('size') == '12' ? 'selected' : '' }}>12</option>
                                        </optgroup>
                                        <!-- Accessories -->
                                        <optgroup label="Accessories" class="accessory-sizes hidden">
                                            <option value="One Size" {{ old('size') == 'One Size' ? 'selected' : '' }}>One Size</option>
                                        </optgroup>
                                    </select>
                                    @error('size')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="listingtype" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Listing Type</label>
                                    <select id="listingtype" name="listingtype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required onchange="togglePriceField()">
                                        <option value="for sale" {{ old('listingtype') == 'for sale' ? 'selected' : '' }}>For Sale</option>
                                        <option value="for donation" {{ old('listingtype') == 'for donation' ? 'selected' : '' }}>For Donation</option>
                                    </select>
                                    @error('listingtype')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div id="price-field">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}" class="block w-full pl-7 pr-12 rounded-md border-gray-300 focus:border-gray-500 focus:ring-gray-500" placeholder="0.00" min="0" step="0.01">
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                List Item
                            </button>
                        </div>
                    </form>
                </div>
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

        function updateSizeOptions() {
            const categorySelect = document.getElementById('category_id');
            const sizeSelect = document.getElementById('size');
            const clothingSizes = document.querySelector('.clothing-sizes');
            const shoeSizes = document.querySelector('.shoe-sizes');
            const accessorySizes = document.querySelector('.accessory-sizes');
            
            // Hide all size groups first
            clothingSizes.classList.add('hidden');
            shoeSizes.classList.add('hidden');
            accessorySizes.classList.add('hidden');
            
            // Reset size selection
            sizeSelect.value = '';
            
            // Get the selected category name
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const categoryName = selectedOption.text.toLowerCase();
            
            // Show relevant size group based on category
            if (categoryName.includes('shirt') || categoryName.includes('clothing') || categoryName.includes('dress') || categoryName.includes('pants')) {
                clothingSizes.classList.remove('hidden');
            } else if (categoryName.includes('shoe') || categoryName.includes('footwear')) {
                shoeSizes.classList.remove('hidden');
            } else {
                accessorySizes.classList.remove('hidden');
            }
        }

        function previewImage(input) {
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');
            const uploadText = document.getElementById('uploadText');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadText.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Initialize size options on page load
        document.addEventListener('DOMContentLoaded', function() {
            togglePriceField();
            updateSizeOptions();
            
            // Add event listener for category change
            document.getElementById('category_id').addEventListener('change', updateSizeOptions);
        });
    </script>
</x-app-layout>

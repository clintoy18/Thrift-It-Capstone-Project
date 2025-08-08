<x-app-layout>
    <div class="py-12  dark:bg-[#F4F2ED]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Image Upload Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-1500 dark:text-gray-500">Product Image</h3>
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
                        </div>

                        <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-1500 dark:text-gray-500">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Item Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter item name" value="{{ old('name') }}" required>
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Category</label>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter detailed description" required>{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-1500 dark:text-gray-500">Product Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="condition" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Condition</label>
                                    <select id="condition" name="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="size" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Size</label>
                                    <select id="size" name="size" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="">Select size</option>
                                        <optgroup label="Clothing" class="clothing-sizes hidden">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </optgroup>
                                        <optgroup label="Shoes" class="shoe-sizes hidden">
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </optgroup>
                                        <optgroup label="Accessories" class="accessory-sizes hidden">
                                            <option value="One Size">One Size</option>
                                        </optgroup>
                                    </select>
                                </div>

                               <div>
                                    <label for="status" class="block text-sm font-medium text-[#000000] dark:text-[#000000]">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                                        <option value="available" selected>Available</option>
                                        <option value="sold">Sold</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-gray-800">
                                List Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateSizeOptions() {
            const categorySelect = document.getElementById('category_id');
            const sizeSelect = document.getElementById('size');
            const clothingSizes = document.querySelector('.clothing-sizes');
            const shoeSizes = document.querySelector('.shoe-sizes');
            const accessorySizes = document.querySelector('.accessory-sizes');

            clothingSizes.classList.add('hidden');
            shoeSizes.classList.add('hidden');
            accessorySizes.classList.add('hidden');
            sizeSelect.value = '';

            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const categoryName = selectedOption.text.toLowerCase();

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

        document.addEventListener('DOMContentLoaded', function() {
            updateSizeOptions();
            document.getElementById('category_id').addEventListener('change', updateSizeOptions);
        });
    </script>
</x-app-layout>

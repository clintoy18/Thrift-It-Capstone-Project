<x-app-layout>
    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile Header -->
            <div class="block md:hidden mb-6">
                <h2 class="text-xl font-bold text-custom-dark text-center">
                    <i>Sell
                    <img src="{{ asset('images/image 165.png') }}" alt="emoji" class="inline-block h-5 w-4 align-middle ml-1">
                    </i>
                </h2>
                <hr class="w-full mt-4 h-px bg-gray-800 border-0 dark:bg-gray-700">
            </div>
            
            <!-- Desktop Header -->
            <div class="hidden md:block relative top-[-30px]">
                <h2 class="text-xl sm:text-2xl font-bold text-custom-dark">
                    <div class="flex flex-col relative right-[130px]">
                        <i>Sell
                        <img src="{{ asset('images/image 165.png') }}" alt="emoji" class="inline-block flex flex-col relative top-[-33px] left-[50px] h-4 w-3 align-middle h-[25px] w-[20px]">
                        </i>
                    </div>
                    <hr class="w-[1270px] mb-9 flex flex-col relative right-[130px] h-px bg-gray-800 border-0 dark:bg-gray-700">
                </h2>
            </div>

            <!-- Main Layout with Form Container -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-20">
                    <!-- Left Side - Image Upload Section (Inside the form) -->
                    <div class="lg:col-span-2 flex flex-col lg:relative lg:right-[100px] lg:top-[150px] w-full lg:w-[400px]">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product Image</h3>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 sm:p-8 bg-white dark:bg-gray-700 min-h-[300px]">
                                <div class="flex flex-col items-center justify-center space-y-6 relative h-full">
                                    <input type="file" name="image" id="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" required onchange="previewImage(this)">
                                    <div id="imagePreview" class="hidden">
                                        <img id="preview" class="max-h-64 w-auto object-contain rounded-lg" src="" alt="Preview">
                                    </div>
                                    <div id="uploadText" class="text-center z-0">
                                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mt-4 text-base text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-500">PNG, JPG up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Side - Form Container -->
                    <div class="lg:col-span-3">
                        <div class="bg-[#F4F2ED] dark:bg-gray-800 shadow-lg rounded-lg overflow-visible w-full lg:w-[643px]">
                            <div class="p-4 sm:p-6">
                                <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Basic Information</h3>
                            <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter item name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                                

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

                                <div>
                                    <label for="segment_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Audience</label>
                                    <select id="segment_id" name="segment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="" disabled selected>Select a segment</option>
                                        @foreach ($segments as $segment)
                                            <option value="{{ $segment->id }}" {{ old('segment_id') == $segment->id ? 'selected' : '' }}>
                                                {{ ucfirst($segment->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('segment_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location Section -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Location</h3>
                                    <div class="mb-8">
                                        <label for="barangay_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barangay</label>
                                        <select id="barangay_id" name="barangay_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                            <option value="" disabled selected>Select a barangay</option>
                                            @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->id }}" {{ old('barangay_id') == $barangay->id ? 'selected' : '' }}>
                                                    {{ $barangay->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('barangay_id')
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
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label for="condition" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condition</label>
                                    <select id="condition" name="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Used</option>
                                    </select>
                                    @error('condition')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                              {{-- MAKE IT AVAILABLE ON DEFAULT --}}
                              <input type="hidden" name="status" value="available">


                                <div>
                                <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Size</label>
                                <select id="size" name="size" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                    <option value="" disabled selected>Select size</option>

                                    <!-- Clothing Sizes -->
                                    <optgroup label="Shirts, Dresses, Outerwear, Pants, Shorts, Skirts">
                                        <option value="XS" {{ old('size') == 'XS' ? 'selected' : '' }}>XS</option>
                                        <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                                        <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                        <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                        <option value="3XL" {{ old('size') == '3XL' ? 'selected' : '' }}>3XL</option>
                                        <option value="4XL" {{ old('size') == '4XL' ? 'selected' : '' }}>4XL</option>
                                        <option value="5XL" {{ old('size') == '5XL' ? 'selected' : '' }}>5XL</option>
                                    </optgroup>

                                    <!-- Shoe Sizes (US Unisex) -->
                                    <optgroup label="Shoes">
                                        <option value="3" {{ old('size') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="3.5" {{ old('size') == '3.5' ? 'selected' : '' }}>3.5</option>
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
                                        <option value="13" {{ old('size') == '13' ? 'selected' : '' }}>13</option>
                                        <option value="14" {{ old('size') == '14' ? 'selected' : '' }}>14</option>
                                    </optgroup>

                                    <!-- Accessories -->
                                    <optgroup label="Accessories">
                                        <option value="One Size" {{ old('size') == 'One Size' ? 'selected' : '' }}>One Size</option>
                                        <option value="Adjustable" {{ old('size') == 'Adjustable' ? 'selected' : '' }}>Adjustable</option>
                                        <option value="Small" {{ old('size') == 'Small' ? 'selected' : '' }}>Small</option>
                                        <option value="Medium" {{ old('size') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="Large" {{ old('size') == 'Large' ? 'selected' : '' }}>Large</option>
                                    </optgroup>

                                    <!-- Socks & Hosiery -->
                                    <optgroup label="Socks & Hosiery">
                                        <option value="Small (S)" {{ old('size') == 'Small (S)' ? 'selected' : '' }}>Small (S)</option>
                                        <option value="Medium (M)" {{ old('size') == 'Medium (M)' ? 'selected' : '' }}>Medium (M)</option>
                                        <option value="Large (L)" {{ old('size') == 'Large (L)' ? 'selected' : '' }}>Large (L)</option>
                                        <option value="Extra Large (XL)" {{ old('size') == 'Extra Large (XL)' ? 'selected' : '' }}>Extra Large (XL)</option>
                                    </optgroup>
                                </select>

                                @error('size')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (PHP)</label>
                                <input type="number" step="0.01" id="price" name="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter price" value="{{ old('price') }}" required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                              <!-- Submit Button -->
                              <div class="flex justify-center sm:justify-end  mt-9 mb-[-40px]">
                                    <button type="submit" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-8 sm:px-10 py-2 rounded-[10px] text-sm sm:text-base font-semibold hover:bg-[#a08e77] transform hover:scale-105 transition-all duration-300 shadow-md w-full sm:w-auto">
                                        Sell Item 
                                    </button>
                                </div>
                            
                        </div>

                                <!-- Submit Button -->
                                <div class="flex justify-center sm:justify-end">
                                    <button type="submit" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-8 sm:px-10 py-2 rounded-[10px] text-sm sm:text-base font-semibold hover:bg-[#a08e77] transform hover:scale-105 transition-all duration-300 shadow-md w-full sm:w-auto">
                                        Sell Item 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Ensure select dropdowns open downward */
        select {
            position: relative;
            z-index: 10;
        }
        
        /* Fix for select dropdown positioning */
        .space-y-4 select,
        .space-y-8 select {
            position: relative;
            z-index: 10;
        }
        
        /* Ensure the form container doesn't clip dropdowns */
        .bg-\[#F4F2ED\] {
            overflow: visible;
        }
        
        /* Specific fix for select elements */
        select:focus {
            z-index: 20;
        }
        
        /* Specific fix for barangay select dropdown */
        #barangay_id {
            position: relative;
            z-index: 15;
            transform: translateZ(0);
        }
        
        #barangay_id:focus {
            z-index: 25;
            transform: translateZ(0);
        }
        
        /* Force dropdown to open downward */
        #barangay_id option {
            position: relative;
        }
        
        /* Ensure the location section doesn't clip the dropdown */
        .space-y-4:has(#barangay_id) {
            overflow: visible;
        }
        
        /* Additional fix for dropdown direction */
        #barangay_id {
            direction: ltr;
        }
        
        /* Force the select to render dropdown below */
        select#barangay_id {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }
        
        /* Force dropdown to only open downward - prevent upward opening */
        #barangay_id {
            position: relative !important;
            z-index: 9999 !important;
            transform: translateY(0) !important;
        }
        
        /* Override browser's automatic upward positioning */
        #barangay_id:focus,
        #barangay_id:active,
        #barangay_id:hover {
            position: relative !important;
            z-index: 9999 !important;
            transform: translateY(0) !important;
        }
        
        /* Ensure parent containers don't interfere */
        .space-y-4,
        .space-y-8,
        .bg-\[#F4F2ED\],
        .dark\\:bg-gray-800 {
            overflow: visible !important;
            position: relative !important;
        }
    </style>

    <script>
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
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

            function updateSizeOptions() {
            const categorySelect = document.getElementById('category_id');
            const sizeSelect = document.getElementById('size');
            const options = sizeSelect.querySelectorAll('optgroup');

            // Hide all groups first
            options.forEach(group => group.style.display = 'none');

            // Get selected category text
            const selectedText = categorySelect.options[categorySelect.selectedIndex]?.text.toLowerCase();

            if (!selectedText) return;

            if (['shirts', 'dresses', 'outerwear', 'pants', 'shorts', 'skirts'].some(cat => selectedText.includes(cat))) {
                sizeSelect.querySelector('optgroup[label="Shirts, Dresses, Outerwear, Pants, Shorts, Skirts"]').style.display = 'block';
            } else if (selectedText.includes('shoe')) {
                sizeSelect.querySelector('optgroup[label="Shoes"]').style.display = 'block';
            } else if (selectedText.includes('accessories') || selectedText.includes('hat') || selectedText.includes('belt')) {
                sizeSelect.querySelector('optgroup[label="Accessories"]').style.display = 'block';
            } else if (selectedText.includes('sock') || selectedText.includes('hosiery')) {
                sizeSelect.querySelector('optgroup[label="Socks & Hosiery"]').style.display = 'block';
            } else {
                // default fallback
                sizeSelect.querySelector('optgroup[label="Accessories"]').style.display = 'block';
            }

            // reset selection when category changes
            sizeSelect.value = '';
        }

        document.getElementById('category_id').addEventListener('change', updateSizeOptions);

        document.addEventListener('DOMContentLoaded', () => {
            updateSizeOptions();
            
            // Force barangay dropdown to open downward without breaking selection
            const barangaySelect = document.getElementById('barangay_id');
            if (barangaySelect) {
                // Set initial positioning
                barangaySelect.style.position = 'relative';
                barangaySelect.style.zIndex = '9999';
                barangaySelect.style.transform = 'translateY(0)';
                
                // Add focus event to ensure proper positioning
                barangaySelect.addEventListener('focus', function() {
                    this.style.position = 'relative';
                    this.style.zIndex = '9999';
                    this.style.transform = 'translateY(0)';
                });
                
                // Add click event to maintain positioning
                barangaySelect.addEventListener('click', function() {
                    this.style.position = 'relative';
                    this.style.zIndex = '9999';
                });
            }
        });

    </script>

</x-app-layout>

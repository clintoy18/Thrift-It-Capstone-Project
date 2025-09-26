<x-app-layout>
    <div class="pt-0 sm:pt-10 pb-0 ">
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
            <div class="hidden md:block flex flex-col relative left-[-150px] top-[-30px]">
                <h2 class="text-xl sm:text-2xl font-bold text-custom-dark">
                    <div  class="flex flex-col relative left-[-90px]">
                        <i>Sell
                        <img src="{{ asset('images/image 165.png') }}" alt="emoji" class="inline-block flex flex-col relative top-[-33px] left-[50px] h-4 w-3 align-middle h-[25px] w-[20px]">
                        </i>
                    </div>
                    <hr class="w-[1270px] mb-9 flex flex-col relative right-[90px] h-px bg-gray-800 border-0 dark:bg-gray-700">
                </h2>
            </div>

            <!-- Main Layout with Form Container -->
            <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-10 items-start lg:relative lg:left-[-150px]">
                    <!-- Left Side - Image Upload Section (multiple with previews) -->
                 <div class="lg:col-span-2 flex flex-col w-full lg:w-[450px]">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Photos</h3>
                    <div id="previewsGrid" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4"></div>
                    <label for="imageInput" class="upload-tile h-40 sm:h-40 cursor-pointer flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                            <span class="text-3xl">+</span>
                            <span class="text-xs mt-1">Add photos</span>
                        </div>
                    </label>
                    <input id="imageInput" name="images[]" type="file" accept="image/*" multiple class="hidden">
                    <p class="mt-2 text-xs text-gray-500">Upload 2–8 photos.</p>

                    <!-- Display validation error -->
                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                    <!-- Right Side - Form Container -->
                    <div class="lg:col-span-3 flex lg:justify-end lg:relative lg:left-[250px] w-[640px] ">
                        <div class="bg-[#F4F2ED] dark:bg-gray-800 shadow-lg rounded-lg overflow-visible w-[150px] lg:w-[680px] ml-auto">
                            <div class="p-4 sm:p-6">
                                <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Basic Information</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Give buyers the essentials about your item.</p>
                            <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
                            <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Item Name <span class="ml-1 text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" placeholder="e.g., Vintage Denim Jacket" value="{{ old('name') }}" required>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use clear, searchable words (brand, material, color).</p>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                                

                                <div>
                                    <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Category <span class="ml-1 text-red-500">*</span></label>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose the closest match so buyers can find it easily.</p>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="segment_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Target Audience <span class="ml-1 text-red-500">*</span></label>
                                    <select id="segment_id" name="segment_id" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" required>
                                        <option value="" disabled selected>Select a segment</option>
                                        @foreach ($segments as $segment)
                                            <option value="{{ $segment->id }}" {{ old('segment_id') == $segment->id ? 'selected' : '' }}>
                                                {{ ucfirst($segment->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Who is this best suited for (e.g., Men, Women, Teens)?</p>
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

        /* Simple tiles for the photo grid */
        .upload-tile {
            border: 2px dashed rgba(209, 213, 219, 1);
            border-radius: 0.5rem;
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            display: block;
        }
        .upload-tile:hover { border-color: rgba(156, 163, 175, 1); }
        .tile-body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            text-align: center;
            color: #6B7280;
            font-size: 0.85rem;
        }
        .tile-preview {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        .tile-label { pointer-events: none; }
        
        /* Preview grid styling */
        #previewsGrid .preview-item {
            position: relative;
            height: 100px;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        #previewsGrid .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #previewsGrid .preview-number {
            position: absolute;
            top: 5px;
            left: 5px;
            background: rgba(0,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        #previewsGrid .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
        }

        /* Mobile-only overrides (no markup changes) */
        @media (max-width: 640px) {
            .w-\[640px\] { width: 100% !important; }
            .w-\[150px\] { width: 100% !important; }
        }
    </style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('imageInput');
    const previewsGrid = document.getElementById('previewsGrid');
    const form = document.getElementById('productForm');
    const errorEl = document.getElementById('imageError');

    // Track all images: existing and newly added
    let existingFiles = Array.from(previewsGrid.querySelectorAll('img')).map(img => ({
        src: img.src,
        id: img.dataset.id // existing image ID
    }));
    let newFiles = [];

    function renderPreviews() {
        previewsGrid.innerHTML = '';

        // Render existing images
        existingFiles.forEach((file, index) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative group';

            const img = document.createElement('img');
            img.src = file.src;
            img.className = 'w-24 h-24 object-cover rounded-xl border';
            wrapper.appendChild(img);

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '&times;';
            btn.className = 'absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-70 hover:opacity-100';
            btn.addEventListener('click', () => removeExistingImage(index));
            wrapper.appendChild(btn);

            previewsGrid.appendChild(wrapper);
        });

        // Render newly added files
        newFiles.forEach((file, index) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative group';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-24 h-24 object-cover rounded-xl border';
            wrapper.appendChild(img);

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.innerHTML = '&times;';
            btn.className = 'absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-70 hover:opacity-100';
            btn.addEventListener('click', () => removeNewFile(index));
            wrapper.appendChild(btn);

            previewsGrid.appendChild(wrapper);
        });
    }

    function removeExistingImage(index) {
        if (existingFiles.length + newFiles.length <= 2) {
            alert('You must keep at least 2 images.');
            return;
        }
        const removed = existingFiles.splice(index, 1)[0];

        // Add a hidden input for deleted images
        const deletedInput = document.createElement('input');
        deletedInput.type = 'hidden';
        deletedInput.name = 'deleted_images[]';
        deletedInput.value = removed.id;
        form.appendChild(deletedInput);

        renderPreviews();
    }

    function removeNewFile(index) {
        if (existingFiles.length + newFiles.length <= 2) {
            alert('You must keep at least 2 images.');
            return;
        }
        newFiles.splice(index, 1);
        updateInputFiles();
        renderPreviews();
    }

    function updateInputFiles() {
        const dt = new DataTransfer();
        newFiles.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }

    input.addEventListener('change', () => {
        const selected = Array.from(input.files);
        selected.forEach(file => {
            if (existingFiles.length + newFiles.length < 8) {
                const key = `${file.name}|${file.size}|${file.lastModified}`;
                // Avoid duplicates
                if (!newFiles.some(f => `${f.name}|${f.size}|${f.lastModified}` === key)) {
                    newFiles.push(file);
                }
            }
        });
        updateInputFiles();
        renderPreviews();
    });

    form.addEventListener('submit', e => {
        if (existingFiles.length + newFiles.length < 2) {
            e.preventDefault();
            errorEl.textContent = 'You must have at least 2 images.';
            errorEl.classList.remove('hidden');
        }
    });

    renderPreviews();
});
</script>

</x-app-layout>
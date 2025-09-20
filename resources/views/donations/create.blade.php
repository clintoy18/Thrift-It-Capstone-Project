<x-app-layout>
<div class="pt-0 sm:pt-10 pb-0 ">     
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8"> 
                 <!-- Mobile Header -->
                      <div class="block md:hidden mb-6">
                            <h2 class="text-xl font-bold text-custom-dark text-center">
                                <i>Sell
                                <img src="{{ asset('images/image 147.png') }}" alt="emoji" class="inline-block h-5 w-4 align-middle ml-1">
                                </i>
                            </h2>
                            <hr class="w-full mt-4 h-px bg-gray-800 border-0 dark:bg-gray-700">
                        </div>
                         <!-- Desktop Header -->
                    <div class="hidden md:block flex flex-col relative left-[-150px] top-[-30px]">
                        <h2 class="text-xl sm:text-2xl font-bold text-custom-dark">
                            <div  class="flex flex-col relative left-[-90px]">
                                <i>Sell
                                <img src="{{ asset('images/image 147.png') }}" alt="emoji" class="inline-block flex flex-col relative top-[-33px] left-[50px] h-4 w-3 align-middle h-[25px] w-[20px]">
                                </i>
                            </div>
                            <hr class="w-[1270px] mb-9 flex flex-col relative right-[90px] h-px bg-gray-800 border-0 dark:bg-gray-700">
                        </h2>
                    </div>
            <!-- Main Layout with Form Container -->
                    <form id="donationForm" action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                  <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-10 items-start lg:relative lg:left-[-150px]">
                        <!-- Left Side - Image Upload Section (multi-select with previews) -->
                     <div class="lg:col-span-2 flex flex-col w-full lg:w-[450px]">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Photos</h3>
                            <div class="w-full">
                                <!-- Preview Grid -->
                                <div id="donationPreviews" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4"></div>

                                <!-- Add Photos Button -->
                                <div class="mb-4">
                                    <label for="donationImages" class="upload-tile h-40 sm:h-40 cursor-pointer flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
                                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                                            <span class="text-3xl">+</span>
                                            <span class="text-xs mt-1">Add photos</span>
                    </div>
                                    </label>
                                </div>

                                <!-- Hidden multiple input -->
                                <input id="donationImages" name="images[]" type="file" accept="image/*" multiple class="hidden">

                                <!-- Helper and error -->
                                <p class="mt-2 text-xs text-gray-500">Upload up to 8 photos. You can add more in steps.</p>
                                <p id="donationImageError" class="mt-2 text-sm text-red-600 hidden">Please upload up to 8 photos.</p>

                            </div>
                        </div>
                    </div>
                           <!-- Right Side - Form Container -->
                           <div class="lg:col-span-3 flex lg:justify-end lg:relative lg:left-[250px] w-[640px] ">
                        <div class="bg-[#F4F2ED] dark:bg-gray-800 shadow-lg rounded-lg overflow-visible w-[150px] lg:w-[680px] ml-auto">
                            <div class="p-4 sm:p-6">
                        <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Basic Information</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Tell us about the item you're donating.</p>
                            <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Item Name <span class="ml-1 text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" placeholder="e.g., Vintage Denim Jacket" value="{{ old('name') }}" required>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Use clear, descriptive words.</p>
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Category <span class="ml-1 text-red-500">*</span></label>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose the closest match for better organization.</p>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Description <span class="ml-1 text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition resize-none" placeholder="Describe the item's condition, any flaws, or special features..." required>{{ old('description') }}</textarea>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Be honest about condition to help recipients make informed decisions.</p>
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">Product Details</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Specify the item's physical characteristics.</p>
                            <div class="h-px w-full bg-gray-200 dark:bg-gray-700"></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="condition" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Condition <span class="ml-1 text-red-500">*</span></label>
                                    <select id="condition" name="condition" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" required>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Be accurate about the item's condition.</p>
                                </div>

                                <div>
                                    <label for="size" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Size <span class="ml-1 text-red-500">*</span></label>
                                    <select id="size" name="size" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition" required>
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
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Size options will update based on category.</p>
                                </div>

                               <div>
                                    <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#B59F84] focus:border-[#B59F84] transition">
                                        <option value="available" selected>Available</option>
                                        <option value="sold">Sold</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Set to Available for donation.</p>
                                </div>
                                
                            </div>
                            <div class="flex justify-center sm:justify-end  mt-9 mb-[-40px]">
                                    <button type="submit" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-8 sm:px-10 py-2 rounded-[10px] text-sm sm:text-base font-semibold hover:bg-[#a08e77] transform hover:scale-105 transition-all duration-300 shadow-md w-full sm:w-auto">
                                        Donate Item 
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
        

    <script>
        // Multi-image selection with previews (accumulate up to 8)
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('donationImages');
            const previews = document.getElementById('donationPreviews');
            const form = document.getElementById('donationForm');
            const errorEl = document.getElementById('donationImageError');
            let selectedFiles = [];

            function showError(msg) {
                if (!errorEl) return;
                errorEl.textContent = msg;
                errorEl.classList.remove('hidden');
            }
            function hideError() {
                if (!errorEl) return;
                errorEl.classList.add('hidden');
            }

            function renderPreviews(files) {
                previews.innerHTML = '';
                files.forEach((file, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'preview-item';
                    const img = document.createElement('img');
                    img.alt = 'Preview ' + (index + 1);
                    const badge = document.createElement('span');
                    badge.className = 'preview-number';
                    badge.textContent = index + 1;
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-btn';
                    removeBtn.textContent = '×';
                    removeBtn.onclick = (e) => { e.preventDefault(); e.stopPropagation(); removeAt(index); };
                    wrapper.appendChild(img);
                    wrapper.appendChild(badge);
                    wrapper.appendChild(removeBtn);
                    previews.appendChild(wrapper);
                    const r = new FileReader();
                    r.onload = (ev) => { img.src = ev.target.result; };
                    r.readAsDataURL(file);
                });
            }

            function syncInput() {
                const dt = new DataTransfer();
                selectedFiles.forEach(f => dt.items.add(f));
                input.files = dt.files;
            }

            function removeAt(idx) {
                selectedFiles.splice(idx, 1);
                syncInput();
                renderPreviews(selectedFiles);
                hideError();
            }

            // Clear input before opening via label (ensures first pick registers)
            const label = document.querySelector('label[for="donationImages"]');
            if (label) {
                label.addEventListener('mousedown', () => { if (input) input.value = ''; });
            }

            input.addEventListener('change', () => {
                hideError();
                const newly = Array.from(input.files || []);
                const makeKey = (f) => `${f.name}|${f.size}|${f.lastModified}`;
                const keys = new Set(selectedFiles.map(makeKey));
                for (const f of newly) {
                    if (selectedFiles.length >= 8) break;
                    const k = makeKey(f);
                    if (keys.has(k)) continue;
                    selectedFiles.push(f);
                    keys.add(k);
                }
                if (selectedFiles.length >= 8 && newly.length > 0) {
                    showError('Limit reached: showing first 8 photos.');
                }
                syncInput();
                renderPreviews(selectedFiles);
            });

            form.addEventListener('submit', (e) => {
                const count = input.files?.length || selectedFiles.length;
                if (count === 0) {
                    e.preventDefault();
                    showError('Please upload at least one photo.');
                } else if (count > 8) {
                    e.preventDefault();
                    showError('Please upload up to 8 photos only.');
                }
            });
        });
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
    <style>
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
        #donationPreviews .preview-item {
            position: relative;
            height: 100px;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        #donationPreviews .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #donationPreviews .preview-number {
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
        #donationPreviews .remove-btn {
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
</x-app-layout>

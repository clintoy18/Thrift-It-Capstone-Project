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
                    <form action="{{ route('donations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                  <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-10 items-start lg:relative lg:left-[-150px]">
                        <!-- Left Side - Image Upload Section (structure only) -->
                     <div class="lg:col-span-2 flex flex-col w-full lg:w-[450px]">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Photos</h3>
                            <div class="w-full">
                                <!-- Top row: Add + Cover Photo -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <!-- Plus tile -->
                                    <label class="upload-tile h-40 sm:h-40">
                                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                                            <span class="text-3xl">+</span>
                                    </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <!-- Cover Photo (required) -->
                                    <label class="upload-tile h-40 sm:h-40">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Cover">
                                            <span class="tile-label">Cover Photo</span>
                                    </div>
                                        <input type="file" id="image" name="image" class="hidden" accept="image/*">
                                    </label>
                                     </div>

                                <!-- 3x2 grid: Front, Back, Side, Label, Detail, Flaw -->
                           
                            
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 w-full   ">
                                    <label class="upload-tile  flex flex-col lg:relative lg:left-[-120px] h-40 w-full sm:w-[210px] sm:h-40 ">
                                        <div class="tile-body ">
                                            <img class="tile-preview hidden" alt="Front">
                                            <span class="tile-label">Front</span>
                                    </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <label class="upload-tile h-40 flex flex-col lg:relative lg:left-[-40px] sm:h-40 w-full sm:w-[210px]">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Back">
                                            <span class="tile-label">Back</span>
                                    </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <label class="upload-tile flex flex-col lg:relative lg:left-[40px] h-40 sm:h-40 w-full sm:w-[210px]">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Side">
                                            <span class="tile-label">Side</span>
                                </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <label class="upload-tile flex flex-col lg:relative lg:left-[-120px] h-40 w-full sm:w-[210px] sm:h-40">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Label">
                                            <span class="tile-label">Label</span>
                            </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <label class="upload-tile h-40 flex flex-col lg:relative lg:left-[-40px] sm:h-40 w-full sm:w-[210px]">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Detail">
                                            <span class="tile-label">Detail</span>
                        </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                    <label class="upload-tile flex flex-col lg:relative lg:left-[40px] h-40 sm:h-40 w-full sm:w-[210px]">
                                        <div class="tile-body">
                                            <img class="tile-preview hidden" alt="Flaw">
                                            <span class="tile-label">Flaw</span>
                    </div>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                           <!-- Right Side - Form Container -->
                           <div class="lg:col-span-3 flex lg:justify-end lg:relative lg:left-[250px] w-[640px] ">
                        <div class="bg-[#F4F2ED] dark:bg-gray-800 shadow-lg rounded-lg overflow-visible w-[150px] lg:w-[680px] ml-auto">
                            <div class="p-4 sm:p-6">
                        <!-- Basic Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter item name" value="{{ old('name') }}" required>
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500" placeholder="Enter detailed description" required>{{ old('description') }}</textarea>
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
                                </div>

                                <div>
                                    <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Size</label>
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
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                                        <option value="available" selected>Available</option>
                                        <option value="sold">Sold</option>
                                    </select>
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
        /* Mobile-only overrides (no markup changes) */
        @media (max-width: 640px) {
            .w-\[640px\] { width: 100% !important; }
            .w-\[150px\] { width: 100% !important; }
        }
    </style>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#F4F2ED] dark:bg-gray-800/90 backdrop-blur overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                        <div class="col-span-1 md:col-span-2">
                        <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full rounded-xl" 
                            :value="old('name', $product->name)" required autofocus />
                    </div>

                    <!-- Category -->
                        <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="block w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                  <!-- Segment -->
                        <div>
                        <x-input-label for="segment_id" :value="__('Segment')" />
                            <select name="segment_id" id="segment_id" class="block w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none" required>
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
                        <div>
                        <x-input-label for="barangay_id" :value="__('Barangay')" />
                            <select name="barangay_id" id="barangay_id" class="block w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none" required>
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
                        <div>
                        <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-2 block w-full rounded-xl" 
                            :value="old('price', $product->price)" required />
                    </div>

                  <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none" required>
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
                    </div>
                 <!-- Image Upload -->
                    <div>
                        <x-input-label for="images" :value="__('Product Images')" />
                        <div id="dropzone" class="mt-2 group relative rounded-2xl border border-gray-200 dark:border-gray-700 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 p-4 transition-shadow">
                            <label for="images" class="block w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 cursor-pointer group-hover:border-[#E1D5B6] transition">
                                <div class="flex items-center gap-5">
                                    <div class="shrink-0 w-14 h-14 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 group-hover:shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5a2 2 0 0 1 2-2h3l2 2h6a2 2 0 0 1 2 2v2H3V5Zm0 6h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8Zm9 7a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">Drag & drop images here</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG or JPG up to 5MB each</p>
                                        <span class="inline-flex items-center gap-1 mt-3 px-3 py-1.5 text-xs font-medium rounded-full bg-[#E1D5B6]/20 text-[#6f5e49] ring-1 ring-[#E1D5B6]/40">Browse files
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 16l-6-6h12l-6 6z"/></svg>
                                        </span>
                                    </div>
                                </div>
                                <input type="file" name="images[]" id="images" class="hidden" accept="image/*" multiple onchange="previewSelectedImages(event)">
                            </label>
                            <div id="preview-container" class="flex flex-wrap gap-3 mt-4">
                                @foreach($product->images as $img)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $img->image) }}" alt="Product Image" class="w-24 h-24 object-cover rounded-xl border">
                                        <button type="button" data-id="{{ $img->id }}" class="absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-70 hover:opacity-100 delete-image-btn">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex items-center justify-between gap-4 pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white bg-[#B59F84] hover:bg-[#a08e77] shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Update Product
                        </button>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800 underline-offset-2 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dz = document.getElementById('dropzone');
        const input = document.getElementById('images');
        const previewContainer = document.getElementById('preview-container');
        let newFiles = []; // Track newly added files

        input.addEventListener('change', e => {
            addFiles(e.target.files);
        });

        dz.addEventListener('drop', e => {
            e.preventDefault();
            dz.classList.remove('ring-2','ring-[#E1D5B6]','shadow-md');
            if(e.dataTransfer.files.length) addFiles(e.dataTransfer.files);
        });

        function addFiles(files) {
            Array.from(files).forEach(file => newFiles.push(file));
            renderNewFiles();
        }

        function renderNewFiles() {
            newFiles.forEach((file, index) => {
                if (!file.rendered) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('relative', 'group');

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.classList.add('w-24', 'h-24', 'object-cover', 'rounded-xl', 'border');
                    wrapper.appendChild(img);

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.innerHTML = '&times;';
                    btn.classList.add('absolute','top-0','right-0','-translate-x-1/4','-translate-y-1/4','bg-red-500','text-white','rounded-full','w-6','h-6','flex','items-center','justify-center','opacity-70','hover:opacity-100');

                    btn.addEventListener('click', () => {
                        const totalImages = previewContainer.querySelectorAll('img').length;
                        if(totalImages <= 2) {
                            alert('You must have at least 2 images.');
                            return;
                        }
                        newFiles.splice(index, 1);
                        wrapper.remove();
                    });
                    wrapper.appendChild(btn);

                    previewContainer.appendChild(wrapper);
                    file.rendered = true;
                }
            });
        }

        // Delete existing images
        document.querySelectorAll('.delete-image-btn').forEach(btn => {
            btn.addEventListener('click', function(){
                const totalImages = previewContainer.querySelectorAll('img').length;
                if(totalImages <= 2) {
                    alert('You must have at least 2 images.');
                    return;
                }

                const imageId = this.getAttribute('data-id');
                const wrapper = this.closest('div');
                wrapper.remove();

                // Mark for deletion
                const deletedInput = document.createElement('input');
                deletedInput.type = 'hidden';
                deletedInput.name = 'deleted_images[]';
                deletedInput.value = imageId;
                dz.appendChild(deletedInput);
            });
        });

    </script>
</x-app-layout>
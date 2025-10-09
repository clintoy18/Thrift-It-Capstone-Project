<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Donation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#F4F2ED] dark:bg-gray-800/90 backdrop-blur overflow-hidden shadow-xl sm:rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                <form id="donationEditForm" method="POST" action="{{ route('donations.update', $donation) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Donation Name -->
                        <div class="col-span-1 md:col-span-2">
                            <x-input-label for="name" :value="__('Donation Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full rounded-xl" 
                                :value="old('name', $donation->name)" required autofocus />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="block w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $donation->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="w-full mt-2 px-3 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#E1D5B6] focus:outline-none" required>
                                <option value="available"
                                    @if($donation->status === 'donated') disabled @endif
                                    {{ old('status', $donation->status) === 'available' ? 'selected' : '' }}>
                                    Available
                                </option>
                                <option value="donated" {{ old('status', $donation->status) === 'donated' ? 'selected' : '' }}>
                                    Donated
                                </option>
                            </select>
                            @if($donation->status === 'donated')
                                <p class="text-sm text-red-600 mt-1">This donation has already been marked as donated and cannot be marked as available again.</p>
                            @endif
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <x-input-label for="image" :value="__('Donation Image')" />
                        
                        <!-- Photo Guidelines -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-4">
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                                Photo Guidelines
                            </h4>
                            <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span><strong>Clear Shot:</strong> Well-lit, in-focus image</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span><strong>Full View:</strong> Show the entire item</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span><strong>Clean Background:</strong> Simple, uncluttered setting</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span><strong>Good Condition:</strong> Show any wear or damage clearly</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span><strong>Size Reference:</strong> Include common objects for scale</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Add Photo Button (matched to products style) -->
                        <div class="mb-4">
                            <label for="donationImage"
                                   id="donationDropZone"
                                   class="upload-tile group cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-gray-300/80 rounded-3xl transition-all duration-500 hover:border-primary-400 hover:shadow-xl bg-white/80 hover:bg-white backdrop-blur-sm p-8 min-h-[192px] sm:min-h-[208px]">

                                <!-- Preview Container -->
                                <div id="donationPreview" class="mb-4 w-full"></div>
                                
                                <!-- Existing image -->
                                @if ($donation->image)
                                    <div id="existingImageContainer" class="flex justify-center mb-4 w-full">
                                        <div class="relative group existing-img-item">
                                            <img src="{{ asset('storage/' . $donation->image) }}" alt="Donation Image" class="w-32 h-32 object-cover rounded-xl border">
                                            <button type="button" id="deleteExistingImage" class="absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-70 hover:opacity-100">&times;</button>
                                        </div>
                                    </div>
                                @else
                                    <div id="existingImageContainer" class="flex justify-center mb-4 w-full hidden"></div>
                                @endif
                                
                                <div id="donationAddMoreText" class="text-center mb-4 hidden">
                                    <p class="text-sm text-[#B59F84] font-medium">Tap to change photo</p>
                                </div>
                                
                                <!-- Drop zone content - only show when no image or can add more -->
                                <div id="dropZoneContent" class="flex flex-col items-center justify-center gap-5 w-full">
                                    <!-- Icon Container with Gradient -->
                                    <div class="flex justify-center w-full">
                                        <div class="shrink-0 w-18 h-18 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center text-gray-600 transition-all duration-500 group-hover:scale-110 group-hover:from-primary-50 group-hover:to-primary-100 group-hover:text-primary-600 shadow-sm group-hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 5a2 2 0 0 1 2-2h3l2 2h6a2 2 0 0 1 2 2v2H3V5Zm0 6h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8Zm9 7a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Content Container -->
                                    <div class="flex flex-col items-center justify-center gap-4 text-center">
                                        <!-- Browse Files Button -->
                                        <span class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-full bg-gradient-to-r from-[#E1D5B6] to-[#d4c6a2] text-[#6f5e49] transition-all duration-500 group-hover:scale-105 group-hover:shadow-lg group-hover:from-[#d4c6a2] group-hover:to-[#c8b994] transform hover:-translate-y-0.5">
                                            Browse files
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300 group-hover:translate-y-0.5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 16l-6-6h12l-6 6z"/>
                                            </svg>
                                        </span>

                                        <!-- File Info -->
                                        <div class="flex flex-col gap-2">
                                            <p class="text-sm font-semibold text-gray-700 bg-gray-100/50 px-3 py-1.5 rounded-lg">PNG or JPG up to 5MB</p>
                                            <span class="text-sm text-gray-600 font-medium">Add or Drag & Drop photo</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hover Glow Effect -->
                                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-primary-100/20 to-blue-100/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
                            </label>
                        </div>
                        
                        <!-- Hidden file input -->
                        <input id="donationImage" name="image" type="file" accept="image/*" class="hidden">

                        <!-- Helper and error -->
                        <p class="mt-2 text-xs text-gray-500">Upload a clear photo of your donation item.</p>
                        <p id="donationImageError" class="mt-2 text-sm text-red-600 hidden"></p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between gap-4 pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white bg-[#B59F84] hover:bg-[#a08e77] shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Donation
                        </button>
                        <a href="{{ route('donations.index') }}" class="text-gray-600 hover:text-gray-800 underline-offset-2 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Single image selection with preview, drag & drop for donations
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('donationImage');
        const preview = document.getElementById('donationPreview');
        const form = document.getElementById('donationEditForm');
        const errorEl = document.getElementById('donationImageError');
        const dropZone = document.getElementById('donationDropZone');
        const addMoreText = document.getElementById('donationAddMoreText');
        const dropZoneContent = document.getElementById('dropZoneContent');
        const existingImageContainer = document.getElementById('existingImageContainer');
        const deleteExistingBtn = document.getElementById('deleteExistingImage');
        let selectedFile = null;

        function showError(msg) {
            if (!errorEl) return;
            errorEl.textContent = msg;
            errorEl.classList.remove('hidden');
        }
        function hideError() {
            if (!errorEl) return;
            errorEl.classList.add('hidden');
        }

        function hasImage() {
            return selectedFile || (existingImageContainer && !existingImageContainer.classList.contains('hidden') && existingImageContainer.querySelector('img'));
        }

        function updateDropZoneVisibility() {
            if (hasImage()) {
                dropZoneContent.classList.add('hidden');
                addMoreText.classList.remove('hidden');
                dropZone.style.minHeight = 'auto';
            } else {
                dropZoneContent.classList.remove('hidden');
                addMoreText.classList.add('hidden');
                dropZone.style.minHeight = '192px';
            }
        }

        function renderPreview(file) {
            preview.innerHTML = '';
            if (!file) return;

            const wrapper = document.createElement('div');
            wrapper.className = 'preview-item relative flex justify-center';
            const img = document.createElement('img');
            img.alt = 'Preview';
            img.className = 'w-32 h-32 object-cover rounded-xl border';
            const removeBtn = document.createElement('span');
            removeBtn.className = 'remove-btn absolute top-0 right-0 -translate-x-1/4 -translate-y-1/4 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs cursor-pointer';
            removeBtn.textContent = '×';
            removeBtn.onclick = (e) => { 
                e.preventDefault(); 
                e.stopPropagation(); 
                selectedFile = null;
                input.value = '';
                renderPreview(null);
                updateDropZoneVisibility();
            };
            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            preview.appendChild(wrapper);
            
            const r = new FileReader();
            r.onload = (ev) => { img.src = ev.target.result; };
            r.readAsDataURL(file);
        }

        function syncInput() {
            if (selectedFile) {
                const dt = new DataTransfer();
                dt.items.add(selectedFile);
                input.files = dt.files;
            } else {
                input.value = '';
            }
        }

        // Clear input before opening via label
        const label = document.querySelector('label[for="donationImage"]');
        if (label) {
            label.addEventListener('mousedown', () => { if (input) input.value = ''; });
        }

        input.addEventListener('change', () => {
            hideError();
            const file = input.files?.[0];
            if (file) {
                // Validate file type
                if (!file.type.match('image.*')) {
                    showError('Please select only image files.');
                    return;
                }
                
                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showError('File size exceeds 5MB limit.');
                    return;
                }
                
                selectedFile = file;
                syncInput();
                renderPreview(selectedFile);
                updateDropZoneVisibility();
            }
        });

        // Drag & Drop support
        if (dropZone) {
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('ring-2', 'ring-blue-400');
            });
            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('ring-2', 'ring-blue-400');
            });
            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('ring-2', 'ring-blue-400');
                const file = e.dataTransfer.files?.[0];
                if (file) {
                    // Validate file type
                    if (!file.type.match('image.*')) {
                        showError('Please select only image files.');
                        return;
                    }
                    
                    // Validate file size (5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        showError('File size exceeds 5MB limit.');
                        return;
                    }
                    
                    selectedFile = file;
                    syncInput();
                    renderPreview(selectedFile);
                    updateDropZoneVisibility();
                }
            });
        }

        // Delete existing image
        if (deleteExistingBtn) {
            deleteExistingBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (existingImageContainer) {
                    existingImageContainer.classList.add('hidden');
                }
                updateDropZoneVisibility();
            });
        }

        // Initialize
        updateDropZoneVisibility();
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
        
        /* Preview styling */
        #donationPreview .preview-item {
            position: relative;
            height: 128px;
            width: 128px;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        #donationPreview .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #donationPreview .remove-btn {
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
    </style>
</x-app-layout>

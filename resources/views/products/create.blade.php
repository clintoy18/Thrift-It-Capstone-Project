<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Product') }}
            </h2>
            <a href="{{ route('products.index') }}" class="ml-auto text-white border p-2 rounded hover:bg-slate-400">Back</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="name" class="block text-gray-300 font-medium mb-2">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                    placeholder="Enter name"
                                    required>
                                <div class="text-red-700">@error('name') {{ $message }} @enderror</div>
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category_id" class="block text-gray-300 font-medium mb-2">Category</label>
                                <select 
                                    id="category_id" 
                                    name="category_id" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-red-700">@error('category_id') {{ $message }} @enderror</div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                                <textarea 
                                    id="description" 
                                    name="description"
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                    placeholder="Enter description"
                                    required>{{ old('description') }}</textarea>
                                <div class="text-red-700">@error('description') {{ $message }} @enderror</div>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block text-gray-300 font-medium mb-2">Price</label>
                                <input 
                                    type="number" 
                                    id="price" 
                                    name="price" 
                                    step="0.01" 
                                    min="0" 
                                    value="{{ old('price') }}"
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                    placeholder="Enter price (e.g., 100.00)"
                                    required>
                                <div class="text-red-700">@error('price') {{ $message }} @enderror</div>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-4">
                                <label for="qty" class="block text-gray-300 font-medium mb-2">Quantity</label>
                                <input 
                                    type="number" 
                                    id="qty" 
                                    name="qty" 
                                    min="1" 
                                    value="{{ old('qty') ?? 1 }}"
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                    placeholder="Enter quantity"
                                    required>
                                <div class="text-red-700">@error('qty') {{ $message }} @enderror</div>
                            </div>

                            <!-- Listing Type -->
                            <div class="mb-4">
                                <label for="listingtype" class="block text-gray-300 font-medium mb-2">Listing Type</label>
                                <select 
                                    id="listingtype" 
                                    name="listingtype" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                    <option value="for sale" {{ old('listingtype') == 'for sale' ? 'selected' : '' }}>For Sale</option>
                                    <option value="for donation" {{ old('listingtype') == 'for donation' ? 'selected' : '' }}>For Donation</option>
                                </select>
                                <div class="text-red-700">@error('listingtype') {{ $message }} @enderror</div>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="block text-gray-300 font-medium mb-2">Status</label>
                                <select 
                                    id="status" 
                                    name="status" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                                <div class="text-red-700">@error('status') {{ $message }} @enderror</div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="block text-gray-300 font-medium mb-2">Product Image</label>
                                <input 
                                    type="file" 
                                    id="image" 
                                    name="image" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500">
                                <div class="text-red-700">@error('image') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            Create Product
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

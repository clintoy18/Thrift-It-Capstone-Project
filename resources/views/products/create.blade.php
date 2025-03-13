<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Products') }}
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
                        <div class="flex flex-row w-full gap-4">
                            <div class="w-1/2">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-300 font-medium mb-2">Name</label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                        placeholder="Enter Title"
                                    >
                                    
                                </div>
                                <div class="text-red-700">@error('name') {{$message}} @enderror</div>
                                
                            </div>
                            <div class="w-1/2">
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-300 font-medium mb-2">Description</label>
                                    <input 
                                        type="text" 
                                        id="description" 
                                        name="description"
                                        value="{{ old('description')}}"
                                        class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                        placeholder="Enter Descr"
                                    >
                                    <div class="text-red-700">@error('description') {{$message}} @enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row w-full gap-4">
                            <div class="w-1/2">
                                <div class="mb-4">
                                    <label for="categories" class="block text-gray-300 font-medium mb-2">Category</label>
                                    <select 
                                        name="categories" 
                                        id="categories"
                                        class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500">
                                        
                                        <option>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <div class="mb-4">
                                    <label for="size" class="block text-gray-300 font-medium mb-2">Size</label>
                                    <input 
                                        type="text" 
                                        id="size" 
                                        name="size" 
                                        step="0.01" 
                                        min="0" 
                                        class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                        placeholder="Enter the size (e.g., 100.00)"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="mb-4">
                                <label for="condtion" class="block text-gray-300 font-medium mb-2">Condtion</label>
                                <input 
                                    type="text" 
                                    id="condtion" 
                                    name="condtion" 
                                    step="0.01" 
                                    min="0" 
                                    class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                    placeholder="Enter the condtion (e.g., 100.00)"
                                >
                            </div>
                        </div>
                    </div>
                        <div class="flex flex-row w-full gap-4">
                            <div class="w-full">
                                <div class="mb-4">
                                    <label for="image" class="block text-gray-300 font-medium mb-2">Image</label>
                                    <input 
                                        type="file" 
                                        id="image" 
                                        name="image" 
                                        class="w-full px-4 py-2 bg-gray-700 text-gray-300 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-500" 
                                        placeholder="Enter the Image"
                                    >
                                </div>
                            </div>
                        </div>
                    
                            
                            <button 
                                type="submit" 
                                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                Create
                            </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
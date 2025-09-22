<x-app-layout>
   <!-- Hero Section -->
<div class="w-full bg-[#F4F2ED] dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-12">
            <!-- Mobile Layout -->
            <div class="flex flex-col md:hidden text-center relative">
                <div class="p-2 font-poppins">
                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-custom-brown leading-tight dark:text-white">
                        Kid's
                    </h1>
                    <p class="font-poppins text-xl text-custom-brown dark:text-white mb-4">
                        Clothing
                    </p>

                    <!-- Description Section -->
                    <div class=" p-4  mb-4">
                        <h2 class="text-lg font-semibold flex relative text-right text-custom-brown dark:text-white mb-2">
                            Sustainable Men's Fashion
                        </h2>
                        <p class="text-sm text-gray-700 dark:text-gray-300 text-left">
                            Discover our curated collection of men's clothing that combines style with sustainability. 
                            Each piece is carefully selected to reduce fashion's environmental impact while keeping you 
                            looking sharp and contemporary.
                        </p>
                    </div>

                    <!-- Features List -->
                    <div class="  p-4 ">
                        <h3 class="text-md font-medium flex relative text-right text-custom-brown dark:text-white mb-2">
                            Why Choose Our Men's Collection?
                        </h3>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 text-left space-y-1">
                            <li class="flex items-start">
                                <span class="text-green-600 mr-2">✓</span>
                                <span>Eco-friendly materials and production</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-600 mr-2">✓</span>
                                <span>Timeless styles that last beyond seasons</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-600 mr-2">✓</span>
                                <span>Fair trade and ethical manufacturing</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-600 mr-2">✓</span>
                                <span>Quality pieces at accessible prices</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Tag -->
                    <span class="absolute bottom-1 right-1 bg-white px-2 py-0.5 rounded-full text-xs text-[#7C6A46] font-medium shadow-sm">
                        Sustainable Fashion
                    </span>
                </div>
            </div>
            
            <!-- Desktop layout (side by side) -->
            <div class="hidden md:flex md:flex-row md:items-center">
                <!-- Text Content for Desktop with Background Image -->
                <div class="p-3 md:w-1/2 font-poppins relative">
                    <!-- Background Image - Adjustable positioning -->
                    <div class="absolute top-[-200px] left-[-150px] z-0 w-[145px] h-[510px]">
                        <img src="{{ asset('images/Rectangle123.png') }}" 
                            alt="Background" 
                            class="w-full h-full">
                    </div>  
                    <!-- Text Content (with higher z-index) -->
                    <div class="relative z-6">
                        <h1 class="text-6xl lg:text-7xl flex relative left-[50px] font-bold text-custom-brown leading-tight dark:text-white">
                            Kid's 
                        </h1>
                        <p class="flex relative left-[170px] font-poppins text-6xl lg:text-3xl">
                            <span class="block h-[10px]" aria-hidden="true"></span>
                            Clothing
                        </p>
                    </div>
                </div>
                
                <!-- Image for Desktop -->
                <div class="md:w-[1900px] h-[400px] flex flex-row gap-[-30] relative p-6 left-[130px] top-[55px] overflow-hidden">
                    <div class=" flex relative right-[70px]">

                   
                    <img src="{{ asset('images/image 159.png') }}" alt="Thrift-IT Sustainable Fashion" class="w-full flex relative left-[180px] max-h-[200px] object-contain">
                    <img src="{{ asset('images/image 161.png') }}" alt="Thrift-IT Sustainable Fashion" class="w-full  flex relative left-[90px] top-[50px] max-h-[240px] object-contain">
                    <img src="{{ asset('images/image 162.png') }}" alt="Thrift-IT Sustainable Fashion" class="w-full flex relative top-[70px] max-h-[260px] object-contain">
                    <img src="{{ asset('images/image 158.png') }}" alt="Thrift-IT Sustainable Fashion" class="w-full flex relative top-[60px] right-[30px] max-h-[200px] object-contain">
                    <img src="{{ asset('images/image 160.png') }}" alt="Thrift-IT Sustainable Fashion" class="w-full flex relative right-[80px] bottom-[0px] max-h-[200px] object-contain">
                </div>
                </div>
            </div>
        </div>
    </div>
<div class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-red-600 dark:text-red-400">{{ $segment->name }} Products</h2>
            </div>

            <div class="rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 sm:p-6">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($products as $product)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                        @if($product->listingtype === 'for donation')
                                            <div class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif

                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-placeholder.png') }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                                            <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                    Quick view
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-2 sm:p-3">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>

                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                {{ $product->category->name ?? 'No Category' }}
                                            </p>

                                            <div class="flex justify-between items-center mt-1">
                                                <p class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-red-600' }}">
                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <x-empty-message message="No products found in this segment." link="{{ route('products.create') }}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
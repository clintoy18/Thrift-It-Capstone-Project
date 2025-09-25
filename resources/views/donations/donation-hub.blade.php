<x-app-layout>

 <!-- Hero Section -->
<div class="w-full bg-[#F4F2ED] dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-12">
        
        <!-- Mobile Layout -->
        <div class="flex flex-col md:hidden text-center relative">
            <div class="p-2 font-poppins">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-green-700 leading-tight dark:text-green-400">
                    Donate Your Items!
                </h1>
                <p class="font-poppins text-xl text-custom-brown dark:text-white mb-4">
                    Give your pre-loved clothes a new life 🌍
                </p>
                 <!-- Donate Now Button -->
                <a href="{{ route('donations.index') }}"
                class="mb-6 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
                    Donate Now
                </a>
                <!-- Description Section -->
                <div class="p-4 mb-4">
                    <h2 class="text-lg font-semibold text-custom-brown dark:text-white mb-2">
                        Make an Impact
                    </h2>
                    <p class="text-sm text-gray-700 dark:text-gray-300 text-left">
                        Every donation counts. By donating your items, you’re helping communities, reducing waste, 
                        and promoting sustainable living. Together, we can create a greener future. 🌱
                    </p>
                </div>

                <!-- Features List -->
                <div class="p-4">
                    <h3 class="text-md font-medium text-custom-brown dark:text-white mb-2">
                        Why Donate With Us?
                    </h3>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 text-left space-y-1">
                        <li class="flex items-start">
                            <span class="text-green-600 mr-2">✓</span>
                            <span>Support local communities in need</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-600 mr-2">✓</span>
                            <span>Reduce clothing waste and pollution</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-600 mr-2">✓</span>
                            <span>Encourage a cycle of reuse and sustainability</span>
                        </li>
                    </ul>
                </div>

                <!-- Eco Quote -->
                <div class="mt-4 italic text-gray-600 dark:text-gray-400 text-sm">
                    "The greatest threat to our planet is the belief that someone else will save it." 🌎
                </div>

                <!-- Tag -->
                <span class="absolute bottom-1 right-1 bg-green-100 px-2 py-0.5 rounded-full text-xs text-green-700 font-medium shadow-sm">
                    Eco-Friendly Giving
                </span>
            </div>
        </div>
        
        <!-- Desktop Layout -->
        <div class="hidden md:flex md:flex-row md:items-center">
            <!-- Text Content for Desktop -->
          <!-- Text Content for Desktop -->
            <div class="p-2 md:w-1/2 font-poppins relative">
                <div class="relative z-6">
                    <h1 class="text-xl lg:text-7xl font-bold text-green-700 leading-tight dark:text-green-400">
                        Donate Your Items!
                    </h1>
                    <p class="mt-2 text-2xl text-custom-brown dark:text-white">
                        Turn clutter into kindness 🌱
                    </p>

                    <!-- Donate Now Button -->
                    <a href="{{ route('donations.index') }}"
                    class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition">
                        Donate Now
                    </a>
                </div>
            </div>
            <!-- Image Section for Desktop -->
            <div class="md:w-1/2 h-[400px] flex justify-between relative p-4">
                <img src="{{ asset('images/donate-clothes.png') }}" 
                    alt="Donate Clothes" 
                    class="w-[32%] h-full object-cover rounded-lg shadow-md">
                
                <img src="{{ asset('images/recycle-reuse.png') }}" 
                    alt="Recycle and Reuse" 
                    class="w-[32%] h-full object-cover rounded-lg shadow-md">

                <img src="{{ asset('images/helping-community.png') }}" 
                    alt="Helping Community" 
                    class="w-[32%] h-full object-cover rounded-lg shadow-md">
            </div>
        </div>
    </div>
</div>
    <div class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">Donation Hub</h2>
                <!-- Button to list or create donation -->
                <a href="{{ route('donations.index') }}" 
                    class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-full bg-[#B59F84] text-white shadow-sm hover:bg-[#a08e77] active:scale-[.98] transition">
                        <span class="font-semibold">My Donation</span>
                </a>
            </div>
               <div class="rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 sm:p-6">
                    @if($donations->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($donations as $donation)
                                <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <a href="{{ route('donations.show', $donation->id) }}" class="block h-full">
                                        @if($donation->listingtype === 'for donation')
                                            <div class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif

                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                                 alt="{{ $donation->name }}" 
                                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                                            <div class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">
                                                    Quick view
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-2 sm:p-3">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white  transition-colors truncate max-w-[70%]">
                                                    {{ $donation->name }}
                                                </h3>
                                                <span class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $donation->size ?? 'L' }}
                                                </span>
                                            </div>

                                            <p class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                {{ $donation->category->name ?? 'No Category' }}
                                            </p>  
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <x-empty-message message="No active donations found." link="{{ route('donations.create') }}" />
                    @endif
                </div>
            </div>
</x-app-layout>

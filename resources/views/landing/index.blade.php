<x-app-layout>
    {{-- Remove the Custom Landing Page Header --}}
    {{-- <nav class="bg-white shadow-sm"> --}}
    {{-- ... existing code ... --}}
    {{-- </nav> --}}

    <!-- Hero Section -->
    <div class="relative bg-[#F4F2ED] h-[600px] overflow-hidden">
        {{-- Remove the overlay as it's for the image --}}
        {{-- <div class="absolute inset-0 bg-gray-800 bg-opacity-50"></div> --}} {{-- Overlay --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col md:flex-row items-center justify-between">
            {{-- Text Content --}}
            <div class="text-gray-800 w-full md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl sm:text-5xl font-bold leading-tight text-[#634600]">Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds</h1>
                <p class="mt-4 text-lg leading-relaxed text-gray-700">Fashion meets purpose — shop, sell, and donate thrifted clothing to embrace a greener future.</p>
                <div class="mt-8">
                    <a href="#" class="inline-block bg-[#B59F84] text-white px-6 py-3 rounded-md text-lg font-semibold hover:bg-[#a08e77] transition duration-300">Get Started</a>
                </div>
            </div>

            {{-- Image --}}
            <div class="w-full md:w-1/2 h-full flex items-center justify-center">
                <img src="{{ asset('images/image 152.png') }}" alt="Hero Image" class="object-contain max-h-full w-auto">
            </div>
        </div>
    </div>

    <!-- Thrift by Fashion Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8">THRIFT BY FASHION</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Shop By Women --}}
                <div class="relative group">
                    <img src="{{ asset('images/women-fashion.jpg') }}" alt="Shop By Women" class="w-full h-96 object-cover rounded-lg shadow-md">
                    {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                    <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-gray-800 text-lg font-semibold">SHOP BY WOMEN</span>
                    </div>
                </div>
                
                {{-- Shop By Men --}}
                <div class="relative group">
                    <img src="{{ asset('images/men-fashion.jpg') }}" alt="Shop By Men" class="w-full h-96 object-cover rounded-lg shadow-md">
                     {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                     <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                         <span class="text-gray-800 text-lg font-semibold">SHOP BY MEN</span>
                    </div>
                </div>
                
                {{-- Shop By Kids --}}
                <div class="relative group">
                    <img src="{{ asset('images/kids-fashion.jpg') }}" alt="Shop By Kids" class="w-full h-96 object-cover rounded-lg shadow-md">
                      {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                      <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                         <span class="text-gray-800 text-lg font-semibold">SHOP BY KIDS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-6 bg-white ">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8">
            <!-- Section Title -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-center text-black">POPULAR THIS WEEK</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm text-center">Discover great finds from our community</p>
            </div>
            
            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Shop By Women --}}
                <div class="relative group">
                    <img src="{{ asset('images/women-fashion.jpg') }}" alt="Shop By Women" class="w-full h-96 object-cover rounded-lg shadow-md">
                    {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                    <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-gray-800 text-lg font-semibold">SHOP BY WOMEN</span>
                    </div>
                </div>
                
                {{-- Shop By Men --}}
                <div class="relative group">
                    <img src="{{ asset('images/men-fashion.jpg') }}" alt="Shop By Men" class="w-full h-96 object-cover rounded-lg shadow-md">
                     {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                     <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                         <span class="text-gray-800 text-lg font-semibold">SHOP BY MEN</span>
                    </div>
                </div>
                
                {{-- Shop By Kids --}}
                <div class="relative group">
                    <img src="{{ asset('images/kids-fashion.jpg') }}" alt="Shop By Kids" class="w-full h-96 object-cover rounded-lg shadow-md">
                      {{-- Updated overlay to a bottom strip with yellow/gold background --}}
                      <div class="absolute inset-x-0 bottom-0 bg-yellow-400 bg-opacity-75 flex items-center justify-center p-2 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                         <span class="text-gray-800 text-lg font-semibold">SHOP BY KIDS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Upcycling and Donate Sections -->
<div class="py-16 bg-[#F4F2ED]">
    <div class=" mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Upcycling Section --}}
            <div class="flex flex-col md:flex-row bg-white p-8  shadow-md items-center">
                {{-- Text Content --}}
                <div class="md:w-1/2 md:pr-8 mb-6 md:mb-0">
                    <h2 class="text-3xl font-bold text-[#634600] mb-4 leading-tight">
                        Revamp Your Wardrobe with Upcycling: Discover Sustainable Style <span class="text-yellow-500">✨</span>
                    </h2>
                    <p class="text-[#786126] mb-6 text-lg">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>
                    <a href="#" class="inline-block bg-[#B59F84] text-white px-8 py-3 rounded-md text-lg font-semibold hover:bg-[#a08e77] transition duration-300">
                        Upcycle Now
                    </a>
                </div>
                {{-- Image --}}
                <div class="md:w-1/2">
                    <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="rounded-lg shadow-md w-full h-80 object-cover">
                </div>
            </div>

            {{-- Donate Section --}}
            <div class="flex flex-col md:flex-row bg-white p-8  shadow-md items-center">
                {{-- Image --}}
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="rounded-lg shadow-md w-full h-80 object-cover">
                </div>
                {{-- Text Content --}}
                <div class="md:w-1/2 md:pl-8">
                    <h2 class="text-3xl font-bold text-[#634600] mb-4 leading-tight">
                        Style with a Purpose: Donate Your Pre-Loved Clothes and Create a Sustainable Future <span class="text-yellow-500">😊</span>
                    </h2>
                    <p class="text-[#786126] mb-6 text-lg">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>
                    <a href="#" class="inline-block bg-[#B59F84] text-white px-8 py-3 rounded-md text-lg font-semibold hover:bg-[#a08e77] transition duration-300">
                        Donate Now
                    </a>
                </div>
            </div>

    </div>
</div>
    <script>
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle the favorite icon
                const svg = this.querySelector('svg');
                if (svg.getAttribute('fill') === 'none') {
                    svg.setAttribute('fill', 'currentColor');
                    svg.setAttribute('stroke', 'none');
                    this.classList.add('text-red-500');
                } else {
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', 'currentColor');
                    this.classList.remove('text-red-500');
                }
            });
        });
    </script>
</x-app-layout>



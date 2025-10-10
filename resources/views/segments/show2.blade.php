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
            <div class="flex justify-between items-center mb-6 relative">
                <h2 class="text-xl font-bold text-red-600 dark:text-red-400">{{ $segment->name }} Products</h2>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 text-sm shadow-sm">
                        <span>Category</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div x-cloak x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg z-20 py-1">
                        <a data-category-link href="{{ route('segments.show', ['segment' => $segment->id]) }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg">All</a>
                        @foreach($categories as $cat)
                            <a data-category-link href="{{ route('segments.show', ['segment' => $segment->id, 'category' => $cat->id]) }}" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg {{ (isset($selectedCategoryId) && (int)$selectedCategoryId === $cat->id) ? 'font-semibold' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="rounded-xl shadow-sm overflow-hidden">
                <div id="productsGrid" class="p-4 sm:p-6">
                    @include('segments.partials.products-grid', ['products' => $products])
                </div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
              const container = document.getElementById('productsGrid');
              document.querySelectorAll('[data-category-link]').forEach(link => {
                link.addEventListener('click', async (e) => {
                  e.preventDefault();
                  const apiUrl = `{{ url('segments/'.$segment->id.'/products') }}` + (e.currentTarget.search || '');
                  const res = await fetch(apiUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
                  const json = await res.json();
                  container.innerHTML = json.html;
                  const newUrl = new URL(window.location);
                  const params = new URLSearchParams(e.currentTarget.search);
                  if (params.get('category')) newUrl.searchParams.set('category', params.get('category')); else newUrl.searchParams.delete('category');
                  window.history.replaceState({}, '', newUrl);
                });
              });
            });
            </script>
        </div>
    </div>
</x-app-layout>
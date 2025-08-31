<x-app-layout>
    <!-- Full-width Jumbotron outside of the main content container -->
    <div class="w-full bg-[#F4F2ED] dark:bg-gray-800 shadow-sm ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile/Small screens layout (stacked) -->
           <div class="flex flex-col md:hidden text-center">
                <!-- Text Content for Mobile -->
                <div class="p-4 font-poppins">
                    <h1 class="text-xl sm:text-2xl font-bold text-[#634600] leading-tight">
                        Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds
                    </h1>
                    <p class="mt-3 text-[#786126] text-sm sm:text-base leading-relaxed">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>
                    <div class="mt-4 flex flex-col relative sm:flex-row justify-center align-items-center gap-3">
                       <div class="flex justify-center">
                        <a href="{{ route('products.create') }}"
                        class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
                                hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[140px]">
                            Get Started
                        </a>
                       </div>
                    </div>
                </div>

                <!-- Image for Mobile -->
                <div class="mt-4 relative rounded-lg overflow-hidden mx-auto max-w-[280px]">
                    <img src="{{ asset('images/image152.png') }}" 
                        alt="Thrift-IT Sustainable Fashion" 
                        class="w-full max-h-[180px] object-contain">
                    <div class="absolute bottom-2 right-2 bg-white px-2 py-0.5 rounded-full text-xs text-[#7C6A46] font-medium shadow-md">
                        Sustainable fashion
                    </div>
                </div>
            </div>


            
            <!-- Desktop layout (side by side) -->
            <div class="hidden md:flex md:flex-row md:items-center">
                <!-- Text Content for Desktop with Background Image -->
                <div class="p-3 md:w-1/2 font-poppins relative">
                    <!-- Background Image - Adjustable positioning -->
                    <div class="absolute top-[-100px] left-[-150px] z-0 w-[145px] h-[485px]">
                        <img src="{{ asset('images/Rectangle123.png') }}" 
                             alt="Background" 
                             class="w-full h-full  ">
                    </div>  
                    <!-- Text Content (with higher z-index) -->
                    <div class="relative z-10">
                        <h1 class="text-5xl lg:text-4xl font-bold text-custom-brown leading-tight dark:text-white">
                            Refresh Your Wardrobe 
                        <span class="block h-[20px]" aria-hidden="true"></span>
                            Sustainably With Thrift-IT's 
                        <span class="block h-[20px]" aria-hidden="true"></span>
                            Unique Finds
                        <span class="block h-[20px]" aria-hidden="true"></span>
                        </h1>
                        <p class="mt-2 text-[#603E14] dark:text-gray-300 text-sm leading-relaxed">
                            Fashion meets purpose — shop, sell, and donate
                        <span class="block h-[0px]" aria-hidden="true"></span>
                            thrifted clothing to embrace a greener future.
                        <span class="block h-[20px]" aria-hidden="true"></span>

                        </p>
                        <div class="mt-4">
                           
                        <div class="flex flex-col relative left-[500px]">
                        <a href="{{ route('products.create') }}" 
                        class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
                                hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[140px]">
                            Get Started
                        </a>
                     </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image for Desktop -->
                <div class="md:w-1/2 flex felx-col relative left-[70px] overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/image152.png') }}" 
                            alt="Thrift-IT Sustainable Fashion" 
                            class="w-full max-h-[500px] object-contain">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8 font-poppins">
           
            <!-- Segment Showcase -->
            <div class="mb-6 text-center sm:text-left">
                <h2 class="text-xl sm:text-2xl font-bold text-custom-dark-brown">
                    <i>THRIFT BY FASHION</i>
                </h2>
            </div>        

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Women Segment -->
                <a href="{{ route('segments.show', ['segment' => '1']) }}" class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                    <img src="{{ asset('storage/segments/women.png') }}" 
                        alt="Shop by Women" 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Men Segment -->
                <a href="{{ route('segments.show', ['segment' => '2']) }}" class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                    <img src="{{ asset('storage/segments/men.png') }}" 
                        alt="Shop by Men" 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Kids Segment -->
                <a href="{{ route('segments.show', ['segment' => '3']) }}" class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                    <img src="{{ asset('storage/segments/kids.png') }}" 
                        alt="Shop by Kids" 
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </a>
            </div>

            <!-- Section Title -->
            <div class="mb-6 text-center sm:text-left mt-12">
                <h2 class="text-xl sm:text-2xl font-bold text-red-600 dark:text-red-400">
                    Featured Donations
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base mt-1">
                    Discover great finds from our community
                </p>
            </div>

            <!-- Donations Section (Secondary) -->
            <div class="rounded-xl shadow-sm overflow-hidden mt-8">
                <div class="p-4 sm:p-6">

                    @if($donations->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($donations as $donation)
                                <div class="group relative  dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
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
                                                <span class="bg-white text-gray-800 px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium">Quick view</span>
                                            </div>
                                        </div>

                                        <div class="p-2 sm:p-3 font-poppins">
                                            <div class="flex justify-between items-start">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
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
        </div>
    </div>
   <div class="py-16  bg-[#F8EED6] overflow-hidden">
  <div class="hidden md:block">
    <div class="absolute top-[1610px] left-[-30px] z-0">
        <img src="{{ asset('images/Ellipse 23.png') }}" alt="Background decoration" class="w-[196px] h-[221px] ">
    </div>

    <div class="mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Upcycling Section --}}
                <div class="flex flex-col md:flex-row relative p-8 items-center scroll-animate left-[50px]">
                    {{-- Text Content --}}
                    <div class="md:w-[800px] md:pr-4 mb-3 md:mb-0">
                        <h2 class="text-3xl font-bold text-[#634600] mb-2 leading-tight" style="font-family: Poppins; font-weight: 800; font-size: 40px; line-height: 100%; letter-spacing: 5%;">
                            Revamp Your Wardrobe With 
                            <span class="block h-[20px]" aria-hidden="true"></span>
                            Upcycling: Discover Sustainable 
                            <span class="block h-[20px]" aria-hidden="true"></span>
                            Style 
                            <img src="{{ asset('images/image 157.png') }}" alt="emoji" class="inline-block h-6 w-6 align-middle h-[40px] w-[40px]">
                            <span class="block h-[20px]" aria-hidden="true"></span>
                        </h2>
                        <p class="font-poppins text-[#603E14] mb-6 text-lg leading-[30px] tracking-[0.1em]">
                            Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                        </p>
                        <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-4 py-3 rounded-[30px] text-lg font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[200px]">
                            Upcycle Now
                        </a>
                    </div>

                    {{-- Image --}}
                    <div class="md:w-1/3 flex flex-col relative left-[30px]">
                        <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="rounded-lg shadow-md w-full h-80 object-cover">
                    </div>
                </div>

                {{-- Donate Section --}}
                <div class="flex flex-col md:flex-row items-center scroll-animate ">
                    {{-- Image --}}
                    <div class="md:w-1/3 flex flex-col relative right-[-80px] ">
                        <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="rounded-lg shadow-md w-full h-80 object-cover">
                    </div>

                    {{-- Text Content --}}
                    <div class="md:w-[800px] flex flex-col relative md:pr-4 mb-3 md:mb-0 left-[200px] ">
                        <h2 class="text-3xl font-bold text-[#634600] mb-2 leading-tight" style="font-family: Poppins; font-weight: 800; font-size: 40px; line-height: 100%; letter-spacing: %;">
                            Style with a Purpose: Donate Your 
                            <span class="block h-[20px]" aria-hidden="true"></span>
                            Pre-Loved Clothes and Create a 
                            <span class="block h-[20px]" aria-hidden="true"></span>
                            Sustainable Future 
                            <img src="{{ asset('images/Rectangle 142.png') }}" alt="emoji" class="inline-block h-6 w-6 align-middle h-[40px] w-[40px]">
                            <span class="block h-[20px]" aria-hidden="true"></span>
                        </h2>
                        <p class="font-poppins text-[#603E14] mb-6 text-lg leading-[30px] tracking-[0.1em]">
                            Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                        </p>
                        <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-4 py-3 rounded-[30px] text-lg font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[200px]">
                            Donate Now
                        </a>
                    </div>
                </div>
                </div>

            </div>

            <div class="absolute top-[2110px] right-[0px] hidden md:block z-0">
                <img src="{{ asset('images/Ellipse 21.png') }}" alt="Background decoration" class="w-[90px] h-[330px] ">
            </div>
        </div>

        {{-- Mobile Version --}}
        <div class="md:hidden  bg-[#F8EED6]">
            <div class="mx-auto px-4 sm:px-10">
                {{-- Mobile Upcycling Section --}}
                <div class="mb-9">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-[#634600] mb-3 leading-tight" style="font-family: Poppins; font-weight: 800; line-height: 120%; letter-spacing: 2%;">
                            Revamp Your Wardrobe With Upcycling: Discover Sustainable Style 
                            <img src="{{ asset('images/image 157.png') }}" alt="emoji" class="inline-block h-5 w-5 align-middle ml-1">
                        </h2>
                        <p class="font-poppins text-[#603E14] mb-6 text-base leading-[24px] tracking-[0.05em] px-4">
                            Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="rounded-lg shadow-md w-full h-64 object-cover">
                    </div>
                       
                    <div class="text-center">
                        <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-10 py-3 rounded-[30px] text-base font-semibold hover:bg-[#a08e77] transition-all duration-200">
                            Upcycle Now
                        </a>
                    </div>
                </div>

                {{-- Mobile Donate Section --}}
                <div class="mb-16">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-[#634600] mb-3 leading-tight" style="font-family: Poppins; font-weight: 800; line-height: 120%; letter-spacing: 2%;">
                            Style with a Purpose: Donate Your Pre-Loved Clothes and Create a Sustainable Future 
                            <img src="{{ asset('images/Rectangle 142.png') }}" alt="emoji" class="inline-block h-5 w-5 align-middle ml-1">
                        </h2>
                        <p class="font-poppins text-[#603E14] mb-6 text-base leading-[24px] tracking-[0.05em] px-4">
                            Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="rounded-lg shadow-md w-full h-64 object-cover">
                    </div>
                    
                    <div class="text-center mb-8">
                        <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-10 py-3 rounded-[30px] text-base font-semibold hover:bg-[#a08e77] transition-all duration-200">
                            Donate Now
                         
                        </a>
                    </div>
                </div>
                
                <!-- Extra bottom spacing -->
                <div class="pb-12"></div>
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
    
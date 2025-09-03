        <x-app-layout>
             <!-- Hero Section -->
    <div class="w-full bg-[#F4F2ED] dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <!-- Mobile Layout -->
            <div class="flex flex-col md:hidden text-center">
                <div class="p-4 font-poppins">
                    <h1 class="text-3xl font-bold text-[#634600] leading-tight mb-4">
                        Refresh Your Wardrobe Sustainably With Thrift-IT's Unique Finds
                    </h1>
                    <p class="text-[#786126] text-base leading-relaxed mb-6">
                        Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                    </p>

                    <div class="relative mb-6">
                        <img src="{{ asset('images/image152.png') }}" 
                             alt="Thrift-IT Sustainable Fashion" 
                             class="mx-auto w-full max-w-[280px] h-auto object-contain">
                        <span class="absolute bottom-2 right-2 bg-white px-3 py-1 rounded-full text-xs text-[#7C6A46] font-medium shadow-sm">
                            Sustainable Fashion
                        </span>
                    </div>

                    <a href="{{ route('products.create') }}"
                       class="inline-flex items-center justify-center bg-[#B59F84] text-white px-8 py-3 rounded-full text-base font-semibold hover:bg-[#a08e77] transform hover:scale-105 transition-all duration-300 shadow-md">
                        Get Started
                    </a>
                </div>
            </div>


                    
                    <!-- Desktop layout (side by side) -->
                    <div class="hidden md:flex md:flex-row md:items-center">
                        <!-- Text Content for Desktop with Background Image -->
                        <div class="p-3 md:w-1/2 font-poppins relative">
                            <!-- Background Image - Adjustable positioning -->
                            <div class="absolute top-[-100px] left-[-150px] z-0 w-[145px] h-[530px]">
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
                               class="inline-flex items-center justify-center bg-[#B59F84] text-white px-3 py-3 rounded-full text-base
                                font-semibold hover:bg-[#a08e77] transform hover:scale-105 transition-all duration-300 shadow-md w-[140px]">
                                    Get Started
                                </a>
                            </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image for Desktop -->
                        <div class="md:w-1/2 flex felx-col relative left-[70px] top-[45px] overflow-hidden">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('images/image152.png') }}" 
                                    alt="Thrift-IT Sustainable Fashion" 
                                    class="w-full max-h-[500px] object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           <!-- First Segment -->
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
            <a href="{{ route('segments.show', ['segment' => '1']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/women.png') }}"
                    alt="Shop by Women"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Men Segment -->
            <a href="{{ route('segments.show', ['segment' => '2']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/men.png') }}"
                    alt="Shop by Men"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Kids Segment -->
            <a href="{{ route('segments.show', ['segment' => '3']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/kids.png') }}"
                    alt="Shop by Kids"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>
        </div>

    </div>
</div>

<!-- Second Segment (Duplicate) -->
<div class="py-6 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8 font-poppins">

        <!-- Segment Showcase -->
        <div class="mb-6 flex items-center justify-center text-center  sm:text-left">
            <h2 class="text-xl sm:text-2xl font-bold text-custom-dark">
                <i>POPULAR THIS WEEK</i>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Women Segment -->
            <a href="{{ route('segments.show', ['segment' => '1']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/women.png') }}"
                    alt="Shop by Women"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Men Segment -->
            <a href="{{ route('segments.show', ['segment' => '2']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/men.png') }}"
                    alt="Shop by Men"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Kids Segment -->
            <a href="{{ route('segments.show', ['segment' => '3']) }}"
                class="relative group overflow-hidden rounded-md shadow-md h-[500px] w-full block">
                <img src="{{ asset('storage/segments/kids.png') }}"
                    alt="Shop by Kids"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </a>
        </div>

    </div>
</div>

        <div class="py-16  bg-[#F8EED6] overflow-hidden">
        <div class="hidden md:block">
            

            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                        {{-- Upcycling Section --}}
                        <div class="flex flex-col md:flex-row relative p-8 items-center scroll-animate left-[50px]">
                            {{-- Text Content --}}
                            <div class="absolute top-[1710px] left-[-30px] z-0">
                                    <img src="{{ asset('images/Ellipse 23.png') }}" alt="Background decoration" class="w-[196px] h-[221px] ">
                                </div>
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

                    <div class="absolute top-[2220px] right-[0px] hidden md:block z-0">
                        <img src="{{ asset('images/Ellipse 21.png') }}" alt="Background decoration" class="w-[90px] h-[330px] ">
                    </div>
                </div>

                {{-- Mobile Version --}}
<div class="md:hidden bg-[#F8EED6] py-10">
    <div class="mx-auto px-5">
        {{-- Mobile Upcycling Section --}}
        <div class="mb-14">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center mb-4">
                    <div class="w-10 h-10 bg-[#634600] rounded-full flex items-center justify-center mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#634600] leading-tight font-poppins">
                        Revamp With Upcycling
                    </h2>
                </div>
                <p class="text-[#603E14] text-base leading-relaxed px-2 font-poppins">
                    Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                </p>
            </div>
            
            <div class="mb-7 relative">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="w-full h-64 object-cover">
                </div>
                <div class="absolute -bottom-3 -right-3 bg-white rounded-full p-2 shadow-md">
                    <img src="{{ asset('images/image 157.png') }}" alt="Recycle emoji" class="h-8 w-8">
                </div>
            </div>
            
            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-[#a08e77] transition-all duration-300 shadow-md transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Upcycle Now
                </a>
            </div>
        </div>

        {{-- Mobile Donate Section --}}
        <div class="mb-12">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center mb-4">
                    <div class="w-10 h-10 bg-[#634600] rounded-full flex items-center justify-center mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2zm10-4a2 2 0 11-4 0 2 2 0 014 0zM4 10a2 2 0 100-4 2 2 0 000 4zm16-2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#634600] leading-tight font-poppins">
                        Donate With Purpose
                    </h2>
                </div>
                <p class="text-[#603E14] text-base leading-relaxed px-2 font-poppins">
                    Fashion with a Purpose—Shop, Upcycle, and Donate to Create a Sustainable Tomorrow.
                </p>
            </div>
            
            <div class="mb-7 relative">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="w-full h-64 object-cover">
                </div>
                <div class="absolute -bottom-3 -right-3 bg-white rounded-full p-2 shadow-md">
                    <img src="{{ asset('images/Rectangle 142.png') }}" alt="Donation emoji" class="h-8 w-8">
                </div>
            </div>
            
            <div class="text-center mt-6">
                <a href="#" class="inline-flex items-center justify-center bg-[#816849] text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-[#a08e77] transition-all duration-300 shadow-md transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2zm10-4a2 2 0 11-4 0 2 2 0 014 0zM4 10a2 2 0 100-4 2 2 0 000 4zm16-2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
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
            
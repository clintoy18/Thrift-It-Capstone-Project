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
                <div class="group overflow-hidden rounded-md shadow-md h-auto w-full">
                    <a href="{{ route('segments.show', ['segment' => '1']) }}" class="block relative">
                        <img src="{{ asset('storage/segments/women.png') }}"
                            alt="Shop by Women"
                            class="w-full h-[400px] object-cover transition-transform duration-300 group-hover:scale-105">
                    </a>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-[#634600] dark:text-white mb-2">Women's Fashion</h3>
                        <p class="text-sm text-[#603E14] dark:text-gray-300">
                            Discover a curated collection of stylish, pre-loved women's clothing. 
                            From everyday essentials to statement pieces, find unique items that 
                            express your personal style while supporting sustainable fashion.
                        </p>
                    </div>
                </div>

                <!-- Men Segment -->
                <div class="group overflow-hidden rounded-md shadow-md h-auto w-full">
                    <a href="{{ route('segments.show', ['segment' => '2']) }}" class="block relative">
                        <img src="{{ asset('storage/segments/men.png') }}"
                            alt="Shop by Men"
                            class="w-full h-[400px] object-cover transition-transform duration-300 group-hover:scale-105">
                    </a>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-[#634600] dark:text-white mb-2">Men's Collection</h3>
                        <p class="text-sm text-[#603E14] dark:text-gray-300">
                            Explore our selection of quality men's apparel. From casual wear to 
                            professional attire, find timeless pieces that combine style, comfort, 
                            and sustainability in every thread.
                        </p>
                    </div>
                </div>

                <!-- Kids Segment -->
                <div class="group overflow-hidden rounded-md shadow-md h-auto w-full">
                    <a href="{{ route('segments.show', ['segment' => '3']) }}" class="block relative">
                        <img src="{{ asset('storage/segments/kids.png') }}"
                            alt="Shop by Kids"
                            class="w-full h-[400px] object-cover transition-transform duration-300 group-hover:scale-105">
                    </a>
                    <div class="p-4 bg-white dark:bg-gray-800">
                        <h3 class="text-lg font-semibold text-[#634600] dark:text-white mb-2">Kids' Corner</h3>
                        <p class="text-sm text-[#603E14] dark:text-gray-300">
                            Adorable and practical clothing for the little ones. Our kids' collection 
                            features gently-used items that are perfect for play, school, and special 
                            occasions while teaching the value of sustainability early.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- NEW: Why Choose Thrift-IT Section -->
    <div class="py-16 bg-gradient-to-br from-[#F8EED6] to-[#F4F2ED] dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#634600] dark:text-white mb-4 font-poppins">
                    Why Choose Thrift-IT?
                </h2>
                <p class="text-lg text-[#603E14] dark:text-gray-300 max-w-3xl mx-auto">
                    We're revolutionizing sustainable fashion by making it accessible, affordable, and impactful for everyone
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-[#F8EED6] dark:bg-[#634600] rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#634600] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#634600] dark:text-white mb-4">Quality Assured</h3>
                    <p class="text-[#603E14] dark:text-gray-300 mb-4">
                        Every item is carefully inspected and authenticated to ensure you receive only the best pre-loved fashion pieces.
                    </p>
                    <ul class="space-y-2 text-sm text-[#603E14] dark:text-gray-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Professional quality checks
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Authenticity verification
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Condition grading system
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-[#F8EED6] dark:bg-[#634600] rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#634600] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#634600] dark:text-white mb-4">Eco-Impact Tracking</h3>
                    <p class="text-[#603E14] dark:text-gray-300 mb-4">
                        See the real environmental impact of your sustainable choices with our carbon footprint calculator.
                    </p>
                    
                </div>

                <!-- Feature 3 -->
                <div class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-[#F8EED6] dark:bg-[#634600] rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#634600] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#634600] dark:text-white mb-4">Community Driven</h3>
                    <p class="text-[#603E14] dark:text-gray-300 mb-4">
                        Join thousands of fashion enthusiasts who believe in sustainable style and circular fashion economy.
                    </p>
                   
                </div>
            </div>

            <!-- Additional Features Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                <!-- Feature 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-[#F8EED6] dark:bg-[#634600] rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-[#634600] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#634600] dark:text-white mb-2">Easy Selling Process</h3>
                            <p class="text-[#603E14] dark:text-gray-300 text-sm">
                                List your pre-loved items in minutes with our streamlined selling process. We handle the logistics while you earn from your sustainable choices.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-[#F8EED6] dark:bg-[#634600] rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-[#634600] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#634600] dark:text-white mb-2">Circular Fashion Impact</h3>
                            <p class="text-[#603E14] dark:text-gray-300 text-sm">
                                Every purchase extends the life of clothing items, reducing textile waste and promoting a true circular fashion economy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-16 bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-[#634600] dark:text-white mb-4">Ready to Make a Difference?</h3>
                <p class="text-[#603E14] dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    Join our community of conscious shoppers and start your sustainable fashion journey today. Every purchase makes an impact.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center justify-center bg-[#816849] text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-[#634600] transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Start Shopping
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('products.create') }}" 
                       class="inline-flex items-center justify-center bg-white text-[#816849] border-2 border-[#816849] px-8 py-4 rounded-full text-lg font-semibold hover:bg-[#F8EED6] transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Sell Your Items
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Rest of the content remains the same -->
    <div class="py-16  bg-[#F8EED6] overflow-hidden">
        <div class="hidden md:block">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Upcycling Section -->
                <div class="flex flex-col md:flex-row relative p-8 items-center scroll-animate left-[50px]">
                    <!-- Text Content -->
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

                    <!-- Image -->
                    <div class="md:w-1/3 flex flex-col relative left-[30px]">
                        <img src="{{ asset('images/upcycling-image.jpg') }}" alt="Upcycling" class="rounded-lg shadow-md w-full h-80 object-cover">
                    </div>
                </div>

                <!-- Donate Section -->
                <div class="flex flex-col md:flex-row items-center scroll-animate ">
                    <!-- Image -->
                    <div class="md:w-1/3 flex flex-col relative right-[-80px] ">
                        <img src="{{ asset('images/donate-image.jpg') }}" alt="Donate" class="rounded-lg shadow-md w-full h-80 object-cover">
                    </div>

                    <!-- Text Content -->
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

    <!-- Mobile Version -->
    <div class="md:hidden bg-[#F8EED6] py-10">
        <div class="mx-auto px-5">
            <!-- Mobile Upcycling Section -->
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

            <!-- Mobile Donate Section -->
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
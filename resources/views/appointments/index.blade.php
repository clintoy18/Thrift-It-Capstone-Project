<x-app-layout>
    <!-- Hero Section -->
    <section class="w-full bg-[#F4F2ED] dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
            <!-- Mobile Layout -->
            <div class="flex flex-col md:hidden text-center relative font-poppins">
                <!-- Title -->
                <h1 class="text-3xl font-extrabold text-green-700 leading-tight dark:text-green-400">
                    Upcycle with Experts!
                </h1>
                <p class="mt-2 text-lg text-custom-brown dark:text-gray-200 mb-6">
                    Transform your old items into something new ✂️
                </p>

                <!-- Button -->
                <a href="{{ route('appointments.myAppointments') }}"
                   class="mb-8 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition">
                    Find an Upcycler
                </a>

                <!-- Description -->
                <div class="bg-white/70 dark:bg-gray-700/60 rounded-lg p-4 shadow-sm mb-6 text-left">
                    <h2 class="text-lg font-semibold text-custom-brown dark:text-white mb-2">
                        Give Items a Second Life
                    </h2>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Work with skilled upcyclers to repurpose your clothes, accessories, 
                        and more. Support creativity, reduce waste, and help build a sustainable future. 🌍
                    </p>
                </div>

                <!-- Features -->
                <div class="bg-white/70 dark:bg-gray-700/60 rounded-lg p-4 shadow-sm text-left">
                    <h3 class="text-md font-medium text-custom-brown dark:text-white mb-2">
                        Why Choose Upcycling?
                    </h3>
                    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-2">
                        <li class="flex items-start"><span class="text-green-600 mr-2">✓</span> Unique, eco-friendly creations</li>
                        <li class="flex items-start"><span class="text-green-600 mr-2">✓</span> Reduce textile waste and landfill use</li>
                        <li class="flex items-start"><span class="text-green-600 mr-2">✓</span> Support local upcycling talent</li>
                    </ul>
                </div>

                <!-- Quote -->
                <p class="mt-6 italic text-gray-600 dark:text-gray-400 text-sm">
                    "Waste isn’t waste until we waste it." 🌱
                </p>

                <!-- Tag -->
                <span class="absolute bottom-1 right-1 bg-green-100 px-2 py-0.5 rounded-full text-xs text-green-700 font-medium shadow">
                    Sustainable Upcycling
                </span>
            </div>

            <!-- Desktop Layout -->
            <div class="hidden md:flex md:flex-row md:items-center gap-8">
                <!-- Text Content -->
                <div class="md:w-1/2 font-poppins">
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-green-700 dark:text-green-400 leading-tight">
                        Upcycle with Experts!
                    </h1>
                    <p class="mt-4 text-xl text-custom-brown dark:text-gray-200">
                        Give your old items a new purpose ♻️
                    </p>

                    <!-- Button -->
                    <a href="{{ route('appointments.myAppointments') }}"
                       class="mt-8 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transition">
                        Find an Upcycler
                    </a>
                </div>

                <!-- Images -->
                <div class="md:w-1/2 h-[420px] flex gap-4 relative">
                    <img src="{{ asset('images/upcycle-fashion.png') }}" 
                         alt="Upcycle Fashion" 
                         class="w-1/2 h-full object-cover rounded-xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
                    <img src="{{ asset('images/upcycle-community.png') }}" 
                         alt="Upcycle Community" 
                         class="w-1/2 h-full object-cover rounded-xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
                </div>
            </div>
        </div>
    </section>

    <!-- Upcycler Cards -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-10 text-gray-900 dark:text-white">
                Meet Our Upcyclers
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($upcyclers as $upcycler)
                    <div class="group relative overflow-hidden bg-[#F4F2ED] dark:bg-gray-800/90 rounded-2xl border border-gray-200 dark:border-gray-700 shadow hover:shadow-2xl transition-all duration-300">
                        <div class="h-20 bg-gradient-to-r from-[#E1D5B6] to-[#cbbda2] dark:from-gray-700 dark:to-gray-600"></div>
                        <div class="p-6">
                            <!-- Avatar -->
                            <div class="-mt-12 mb-4 w-20 h-20 mx-auto rounded-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 flex items-center justify-center text-lg font-bold text-gray-800 dark:text-gray-200 shadow-md">
                                {{ strtoupper(substr($upcycler->fname,0,1).substr($upcycler->lname,0,1)) }}
                            </div>

                            <!-- Name & Email -->
                            <div class="text-center">
                                <a href="{{ route('profile.show', $upcycler->id) }}" class="inline-block">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-[#6f5e49] transition-colors">
                                        {{ $upcycler->fname }} {{ $upcycler->lname }}
                                    </h3>
                                </a>
                                <div class="mt-2 flex items-center justify-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20 4H4a2 2 0 0 0-2 2v.01L12 13l10-6.99V6a2 2 0 0 0-2-2Zm0 4.236-8 5.59-8-5.59V18a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.236Z"/>
                                    </svg>
                                    <a href="mailto:{{ $upcycler->email }}" class="hover:underline">{{ $upcycler->email }}</a>
                                </div>
                            </div>

                            <!-- Specialization -->
                            <div class="mt-4 flex justify-center gap-2 flex-wrap">
                                <span class="px-3 py-1 text-xs rounded-full bg-white text-gray-700 border border-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">Specialization</span>
                                <span class="px-3 py-1 text-xs rounded-full bg-[#E1D5B6]/30 text-[#6f5e49] ring-1 ring-[#E1D5B6]/40">
                                    {{ $upcycler->specialization ?? 'N/A' }}
                                </span>
                            </div>

                            <!-- Button -->
                            <div class="mt-6">
                                <a href="{{ route('appointments.create', ['upcycler_id' => $upcycler->id]) }}" 
                                   class="w-full inline-flex items-center justify-center gap-2 bg-[#B59F84] hover:bg-[#a08e77] text-white font-semibold py-2.5 px-4 rounded-full shadow-md transition active:scale-[.98]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Request Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>

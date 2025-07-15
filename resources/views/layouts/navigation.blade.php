<nav class="w-full bg-[#d9d9d9] px-4 sm:px-6 md:px-8 py-4 border-b border-gray-300 h-20">
    <div class="max-w-7xl mx-auto h-full flex flex-col justify-center" x-data="{ mobileMenuOpen: false, mobileSearchOpen: false }">
        <!-- Mobile Nav Row: Logo/Search, Menu Toggle -->
        <div class="flex items-center justify-between md:hidden w-full py-2 px-2">
            <!-- Logo (mobile only, hidden when search is open) -->
            <template x-if="!mobileSearchOpen">
                <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="block md:hidden">
                    <img src="{{ asset('images/nipis 4.png') }}" alt="Thrift-IT Logo" class="h-8 w-auto">
                </a>
            </template>
            <!-- Search Bar (replaces logo when open) -->
            <template x-if="mobileSearchOpen">
                <form action="{{ route('search') }}" method="GET" class="flex items-center bg-white px-3 py-1 rounded-full shadow border border-gray-200 w-full mr-2">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for products, categories..." class="w-full border-none outline-none focus:outline-none focus:ring-0 text-base bg-transparent text-gray-700 placeholder-gray-400" required>
                    <button type="submit" class="ml-3 text-gray-500 hover:text-[#B59F84] transition-colors duration-200 p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </template>
            <div class="flex items-center gap-2 ml-auto">
                <!-- Search Icon (shows search bar, hidden when search is open) -->
                <button @click="mobileSearchOpen = true" x-show="!mobileSearchOpen" class="p-2 rounded-full bg-white shadow text-gray-700 hover:bg-[#B59F84] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#B59F84] transition-all duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
                <!-- Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-3 rounded-full bg-white shadow-md text-gray-700 hover:bg-[#B59F84] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#B59F84] transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Desktop Navigation -->
        <div class="flex justify-between items-center">
            <!-- Logo (hidden on mobile, visible on desktop) -->
            <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="flex-shrink-0 hidden md:block">
                <img src="{{ asset('images/nipis 4.png') }}" alt="Thrift-IT Logo" class="h-10 w-auto md:h-12">
            </a>
            
            <!-- Search Bar (Hidden on small mobile, visible on larger screens) -->
            <div class="hidden md:flex items-center bg-white px-6 py-2 rounded-full w-full max-w-lg shadow-md border border-gray-200 mx-6 hover:shadow-lg transition-shadow duration-200">
                <form action="{{ route('search') }}" method="GET" class="flex w-full items-center">
                    <input type="text" name="query" value="{{ request('query') }}" 
                        placeholder="Search for products, categories..."
                        class="w-full border-none outline-none focus:outline-none focus:ring-0 text-base bg-transparent text-gray-700 placeholder-gray-400"
                        required>
                    <button type="submit" class="ml-3 text-gray-500 hover:text-[#B59F84] transition-colors duration-200 p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Right Icons (Desktop) -->
            <div class="hidden md:flex items-center gap-2 lg:gap-4">
                <a href="#" class="text-gray-700 text-lg">🤍</a> <!-- Wishlist -->
                <a href="#" class="text-gray-700 text-lg">🛒</a> <!-- Cart -->

                @auth
                    @php    
                        $role = Auth::user()->role;
                    @endphp

                    @if($role === 0) <!-- Regular User -->
                        <a href="{{ route('products.index') }}" class="text-gray-700 hidden lg:block">My Products</a>
                        <a href="{{ route('products.create') }}" class="bg-black text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition">
                            Sell now
                        </a>
                        <a href="{{ route('appointments.index') }}" class="bg-black text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition">
                            Upcycle
                        </a>
                    @elseif($role === 1) <!-- Upcycler -->
                        <a href="{{ route('upcycler.index') }}" class="bg-black text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition">
                            Manage Appointments
                        </a>
                    @endif
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = ! open" class="text-gray-700 flex items-center">
                            <span>{{ Auth::user()->lname }}</span>
                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md z-10">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-200">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="border border-gray-400 px-4 py-2 text-sm rounded hover:bg-gray-100 transition">Sign up</a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu (Conditional Rendering) -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden mt-32 py-4 bg-white rounded-2xl shadow-2xl border border-gray-200 mx-1 z-50 relative">
            <!-- Close (X) Button -->
            <button @click="mobileMenuOpen = false" class="absolute top-2 right-2 p-2 rounded-full bg-gray-100 hover:bg-[#B59F84] hover:text-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#B59F84] transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex flex-col space-y-3 px-4">
                <a href="#" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">
                    <span class="mr-3 text-xl">🤍</span> Wishlist
                </a>
                <a href="#" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">
                    <span class="mr-3 text-xl">🛒</span> Cart
                </a>
                @auth
                    @if($role === 0)
                        <a href="{{ route('products.index') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">My Products</a>
                        <a href="{{ route('products.create') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Sell Now</a>
                        <a href="{{ route('appointments.index') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Upcycle</a>
                    @elseif($role === 1)
                        <a href="{{ route('upcycler.index') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Manage Appointments</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Sign up</a>
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 py-3 rounded-lg hover:bg-[#F4F2ED] hover:text-[#B59F84] transition-colors duration-200">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Categories Navigation (Responsive) -->
    <div class="bg-[#d9d9d9] py-2 mt-2">
        @if(Auth::check() && Auth::user()->role === 0)
            <div class="max-w-7xl mx-auto px-2">
                <!-- Desktop Categories -->
                <div class="hidden md:flex items-center justify-center space-x-6">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}" 
                           class="text-sm font-medium text-gray-700 hover:text-red-600 transition-colors duration-200">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Mobile Categories -->
                <div class="md:hidden" x-data="{ mobileCategoriesOpen: false }">
                    <button @click="mobileCategoriesOpen = !mobileCategoriesOpen" 
                            class="w-full flex items-center justify-between px-4 py-2 bg-white text-gray-700 rounded-lg shadow-sm hover:bg-gray-50">
                        <span class="font-medium">Categories</span>
                        <svg class="w-5 h-5" :class="{'transform rotate-180': mobileCategoriesOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="mobileCategoriesOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="mt-2 bg-white rounded-lg shadow-lg overflow-hidden">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category->id) }}" 
                               class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</nav>
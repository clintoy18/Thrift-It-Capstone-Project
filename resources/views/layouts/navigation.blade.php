<nav class="w-full bg-[#d9d9d9] px-4 sm:px-6 md:px-8 py-3 border-b border-gray-300">
    <div class="max-w-7xl mx-auto" x-data="{ mobileMenuOpen: false }">
        <!-- Desktop Navigation -->
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="text-xl sm:text-2xl font-bold text-red-600 flex-shrink-0">
                THRIFT - IT
            </a>
            
            
            <!-- Search Bar (Hidden on small mobile, visible on larger screens) -->
            <div class="hidden md:flex items-center bg-white px-4 py-2 rounded-full w-full max-w-md shadow-sm border mx-4">
                <form action="{{ route('search') }}" method="GET" class="flex w-full items-center">
                    <input type="text" name="query" value="{{ request('query') }}" 
                        placeholder="Search for a product..."
                        class="w-full border-none outline-none text-sm bg-transparent text-gray-700"
                        required>
                    <button type="submit" class="ml-2 text-gray-500 hover:text-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 1 2.83 6.83l3.88 3.88a1 1 0 0 1-1.42 1.42l-3.88-3.88A4 4 0 0 1 8 4zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Right Icons (Desktop) -->
            <div class="hidden md:flex items-center gap-2 lg:gap-4">
                <a href="#" class="text-gray-700">🤍</a> <!-- Wishlist -->
                <a href="#" class="text-gray-700">🛒</a> <!-- Cart -->

                @auth
                    @php
                        $role = Auth::user()->role;
                    @endphp

                    @if($role === 0) <!-- Regular User -->
                        <a href="{{ route('products.index') }}" class="text-gray-700 hidden lg:block">My Products</a>
                        <a href="{{ route('products.create') }}" class="bg-black text-white px-3 py-1.5 text-sm rounded hover:bg-gray-800 transition">
                            Sell now
                        </a>
                        <a href="{{ route('appointments.index') }}" class="bg-black text-white px-3 py-1.5 text-sm rounded hover:bg-gray-800 transition">
                            Upcycle
                        </a>
                         <a href="{{ route('donations.index') }}" class="bg-black text-white px-3 py-1.5 text-sm rounded hover:bg-gray-800 transition">
                            Donate
                        </a>
                    @elseif($role === 1) <!-- Upcycler -->
                        <a href="{{ route('upcycler.index') }}" class="bg-black text-white px-3 py-1.5 text-sm rounded hover:bg-gray-800 transition">
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
                    <a href="{{ route('register') }}" class="border border-gray-400 px-3 py-1.5 text-sm rounded hover:bg-gray-100 transition">Sign up</a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="flex md:hidden items-center gap-2">
                <!-- Mobile Search Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="mt-3 md:hidden">
            <form action="{{ route('search') }}" method="GET" class="flex items-center bg-white px-3 py-2 rounded-full shadow-sm border">
                <input type="text" name="query" value="{{ request('query') }}" 
                    placeholder="Search for a product..."
                    class="w-full border-none outline-none text-sm bg-transparent text-gray-700"
                    required>
                <button type="submit" class="ml-2 text-gray-500 hover:text-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 1 2.83 6.83l3.88 3.88a1 1 0 0 1-1.42 1.42l-3.88-3.88A4 4 0 0 1 8 4zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Mobile Menu (Conditional Rendering) -->
        <div x-show="mobileMenuOpen" class="md:hidden mt-2 py-2 bg-gray-100 rounded-lg shadow-md">
            <div class="flex flex-col space-y-2 px-4">
                <a href="#" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                    <span class="mr-2">🤍</span> Wishlist
                </a>
                <a href="#" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                    <span class="mr-2">🛒</span> Cart
                </a>
                
                @auth
                    @if($role === 0)
                        <a href="{{ route('products.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">My Products</a>
                        <a href="{{ route('products.create') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Sell Now</a>
                        <a href="{{ route('appointments.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Upcycle</a>
                    @elseif($role === 1)
                        <a href="{{ route('upcycler.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Manage Appointments</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center text-gray-700 py-2 hover:text-red-600">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Sign up</a>
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Login</a>
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

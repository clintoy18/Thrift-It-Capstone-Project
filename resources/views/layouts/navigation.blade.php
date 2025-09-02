<nav class="w-full bg-[#F4F2ED] px-4 sm:px-6 md:px-8 py-6">
    <div class="max-w-7xl mx-auto" x-data="{ mobileMenuOpen: false }">
        <!-- Desktop Navigation -->
     <div class="flex justify-between items-center">
    <!-- Logo -->
   <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="flex-shrink-0">
        <img src="{{ asset('storage/bgimages/logo.png') }}" alt="THRIFT - IT Logo" class="h-10 sm:h-12">                      
    </a>

    <!-- Navigation Links for Authenticated User -->
    @auth
        @php $role = Auth::user()->role; @endphp
        <div class="hidden md:flex items-center gap-2 lg:gap-4 ml-6">
            @if($role === 0)
                <a href="{{ route('products.index') }}" class="text-gray-700 hidden font-bold lg:block">My Products</a>
                <a href="{{ route('products.create') }}" class="text-gray-700 hidden font-bold lg:block">Sell</a>
                <a href="{{ route('donations.index') }}" class="text-gray-700 hidden font-bold lg:block">Donate</a>
                <a href="{{ route('appointments.index') }}" class="text-gray-700 hidden font-bold lg:block">Upcycle</a>
            @elseif($role === 1)
                <a href="{{ route('upcycler.index') }}" class="bg-black text-white px-3 py-1.5 text-sm rounded hover:bg-gray-800 transition">Manage Appointments</a>
            @endif
        </div>
    @endauth

 <!-- Search Bar -->
<div class="hidden md:flex items-center bg-[#F4F2ED] px-4 rounded-full w-full max-w-md border border-gray-400 mx-4">
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


    <!-- Icons + Dropdown -->
    <div class="hidden md:flex items-center gap-2 lg:gap-4">
        <a href="#" class="text-gray-700">🤍</a> <!-- Wishlist -->
        <a href="#" class="text-gray-700">🛒</a> <!-- Cart -->

        @auth
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
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                        px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
                                        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[100px]">Sign up</a>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                        px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
                                        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[100px]">Login</a>
        @endauth
    </div>

    <!-- Mobile Menu Toggle -->
    <div class="flex md:hidden items-center gap-2">
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

</nav>

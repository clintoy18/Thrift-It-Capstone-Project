<nav class="w-full bg-[#d9d9d9] px-8 py-3 border-b border-gray-300">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/dashboard') }}" class="text-2xl font-bold text-red-600">
            THRIFT - IT
        </a>
        
       <!---Search Bar--->
        <form action="{{ route('search') }}" method="GET" class="flex items-center bg-white px-4 py-2 rounded-full w-full max-w-md shadow-sm border">
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
        <!-- Right Icons (Wishlist, Cart, Sell Now, My Products, Profile) -->
        <div class="flex items-center gap-4">
            <a href="#" class="text-gray-700">🤍</a> <!-- Wishlist -->
            <a href="#" class="text-gray-700">🛒</a> <!-- Cart -->

            @auth
                @php
                    $role = Auth::user()->role;
                @endphp

                @if($role === 0) <!-- Regular User -->
                    <a href="{{ route('products.index') }}" class="text-gray-700">My Products</a>
                    <a href="{{ route('products.create') }}" class="bg-black text-white px-4 py-1.5 text-sm rounded">
                        Sell now
                    </a>
                    <a href="{{ route('appointments.index') }}" class="bg-black text-white px-4 py-1.5 text-sm rounded">
                        Upcycle
                    </a>
                @elseif($role === 1) <!-- Upcycler -->
                    <a href="{{ route('upcycler.index') }}" class="bg-black text-white px-4 py-1.5 text-sm rounded">
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
                    <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md z-10">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-200">
                                Log Out
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('register') }}" class="border px-4 py-1.5 text-sm rounded">Sign up</a>
                <a href="{{ route('login') }}" class="text-gray-700">Login</a>
            @endauth
        </div>
    </div>
    
    <!-- Categories Navigation (Right-aligned) -->
    <div class="bg-[#d9d9d9] py-2 mt-2">
        @if(Auth::check() && Auth::user()->role === 0)
            <div class="max-w-7xl mx-auto flex space-x-6 font-semibold">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->id) }}" 
                    class="text-black hover:text-red-500 {{ $category->name == 'Sale' ? 'text-red-600 font-bold' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</nav>

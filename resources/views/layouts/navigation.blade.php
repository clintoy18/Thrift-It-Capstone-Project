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
                <a href="{{ route('dashboard') }}" class="text-gray-700 hidden font-bold lg:block">Home</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hidden font-bold lg:block">Sell</a>
                <a href="{{ route('donations.hub') }}" class="text-gray-700 hidden font-bold lg:block">Donation Hub</a>
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
            <a href="{{ route('messages.index') }}" class="text-gray-700 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <!-- Unread indicator could go here -->
            </a>
          <!-- Notification Bell -->
            <div id="notif-bell" 
                x-data="{
                    open: false,
                    notifications: [],
                    markAsRead() {
                        fetch('{{ route('notifications.read') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        }).then(() => {
                            this.notifications.forEach(n => n.is_read = true);
                        });
                    }
                }"
                x-init="
                    notifications = {{ Js::from(
                        \App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get()
                    ) }};
                "
                @new-notification.window="notifications.unshift($event.detail)">
                
                <!-- Bell Icon -->
                <button @click="open = !open; if(open) markAsRead()" class="relative">
                    🔔
                    <span x-show="notifications.filter(n => !n.is_read).length > 0"
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">
                        <span x-text="notifications.filter(n => !n.is_read).length"></span>
                    </span>
                </button>

                <!-- Dropdown -->
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition
                    class="absolute right-20 mt-2 w-72 bg-white shadow-lg rounded-xl overflow-hidden z-50 border border-gray-200"
                >
                    <!-- Header -->
                    <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                        <span class="text-sm font-semibold text-gray-700">Notifications</span>
                    </div>

                    <!-- Notification List -->
                    <div class="max-h-64 overflow-y-auto divide-y divide-gray-100 custom-scroll">
                        <template x-for="notif in notifications" :key="notif.id">
                            <a :href="`/products/${notif.data.product_id}`" 
                            class="block px-4 py-3 hover:bg-gray-50 transition">
                                <p class="text-sm text-gray-700">
                                    <strong class="text-[#B59F84]" x-text="notif.data.from_user"></strong>
                                    commented: <span x-text="notif.data.content"></span>
                                </p>
                                <span class="text-xs text-gray-400" x-text="notif.created_at"></span>
                            </a>
                        </template>
                    </div>

                    <!-- Footer -->
                    {{-- <div class="px-4 py-2 text-center bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('notifications.index') }}" class="text-sm text-[#B59F84] hover:underline">
                            View all
                        </a>
                    </div> --}}
                </div>
            </div>

            <!-- Custom Scrollbar (optional, Tailwind extension via CSS) -->
            <style>
            .custom-scroll::-webkit-scrollbar {
                width: 6px;
            }
            .custom-scroll::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            .custom-scroll::-webkit-scrollbar-thumb {
                background: #b59f84;
                border-radius: 9999px;
            }
            .custom-scroll::-webkit-scrollbar-thumb:hover {
                background: #786126;
            }
            </style>

        @endauth
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
             <!-- Notification Bell -->
            <div id="notif-bell" 
                x-data="{
                    open: false,
                    notifications: [],
                    markAsRead() {
                        fetch('{{ route('notifications.read') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        }).then(() => {
                            this.notifications.forEach(n => n.is_read = true);
                        });
                    }
                }"
                x-init="
                    notifications = {{ Js::from(
                        \App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get()
                    ) }};
                "
                @new-notification.window="notifications.unshift($event.detail)">
                
                <!-- Bell Icon -->
                <button @click="open = !open; if(open) markAsRead()" class="relative">
                    🔔
                    <span x-show="notifications.filter(n => !n.is_read).length > 0"
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">
                        <span x-text="notifications.filter(n => !n.is_read).length"></span>
                    </span>
                </button>

                <!-- Dropdown -->
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition
                    class="absolute right-20 mt-2 w-72 bg-white shadow-lg rounded-xl overflow-hidden z-50 border border-gray-200"
                >
                    <!-- Header -->
                    <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                        <span class="text-sm font-semibold text-gray-700">Notifications</span>
                    </div>

                    <!-- Notification List -->
                    <div class="max-h-64 overflow-y-auto divide-y divide-gray-100 custom-scroll">
                        <template x-for="notif in notifications" :key="notif.id">
                            <a :href="`/products/${notif.data.product_id}`" 
                            class="block px-4 py-3 hover:bg-gray-50 transition">
                                <p class="text-sm text-gray-700">
                                    <strong class="text-[#B59F84]" x-text="notif.data.from_user"></strong>
                                    commented: <span x-text="notif.data.content"></span>
                                </p>
                                <span class="text-xs text-gray-400" x-text="notif.created_at"></span>
                            </a>
                        </template>
                    </div>

                    <!-- Footer -->
                    {{-- <div class="px-4 py-2 text-center bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('notifications.index') }}" class="text-sm text-[#B59F84] hover:underline">
                            View all
                        </a>
                    </div> --}}
                </div>
            </div>

            <!-- Custom Scrollbar (optional, Tailwind extension via CSS) -->
            <style>
            .custom-scroll::-webkit-scrollbar {
                width: 6px;
            }
            .custom-scroll::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            .custom-scroll::-webkit-scrollbar-thumb {
                background: #b59f84;
                border-radius: 9999px;
            }
            .custom-scroll::-webkit-scrollbar-thumb:hover {
                background: #786126;
            }
            </style>

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
                    <a href="{{ route('messages.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Messages
                    </a>
                @endauth
                
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

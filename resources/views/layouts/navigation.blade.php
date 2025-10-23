<nav class="w-full bg-[#F4F2ED] px-4 sm:px-6 md:px-8 py-6 relative z-50">
    <div class="max-w-7xl mx-auto" x-data="{ mobileMenuOpen: false }">
        <!-- Desktop Navigation -->
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}"
                class="flex-shrink-0">
                <img src="{{ asset('storage/bgimages/logo.png') }}" alt="THRIFT - IT Logo" class="h-10 sm:h-12">
            </a>

            <!-- Navigation Links for Authenticated User -->
            @auth
                @php $role = Auth::user()->role; @endphp
                <div class="hidden md:flex items-center gap-2 lg:gap-4 ml-6">
                    @if ($role === 0)
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hidden font-bold lg:block">Home</a>
                        <a href="{{ route('products.index') }}" class="text-gray-700 hidden font-bold lg:block">Sell</a>
                        <a href="{{ route('donations.hub') }}" class="text-gray-700 hidden font-bold lg:block">Donation Hub</a>
                        <a href="{{ route('appointments.index') }}" class="text-gray-700 hidden font-bold lg:block">Upcycle</a>
                    @elseif($role === 1)
                        <a href="{{ route('upcycler.index') }}" class="text-gray-700 hidden font-bold lg:block">Manage Appointments</a>
                    @endif
                </div>
            @endauth

             <!-- Search Bar (Hide for Admin) -->
            @auth
                @if ($role !== 2)
                    <div class="hidden md:flex items-center bg-[#F4F2ED] px-4 rounded-full w-full max-w-md border border-gray-400 mx-4">
                        <form action="{{ route('search') }}" method="GET" class="flex w-full items-center">
                            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for a product..."
                                class="w-full outline-none text-sm bg-transparent border-0 focus:outline-none focus:ring-0 focus:border-0 focus:shadow-none" required>
                            <button type="submit" class="ml-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 1 1 2.83 6.83l3.88 3.88a1 1 0 0 1-1.42 1.42l-3.88-3.88A4 4 0 0 1 8 4zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            @endauth


            <!-- Icons + Dropdown -->
            <div class="hidden md:flex items-center gap-2 lg:gap-4">
                @auth
                    @if ($role !== 2)
                        <a href="#" class="text-gray-700">🤍</a> <!-- Wishlist -->
                        <a href="#" class="text-gray-700">🛒</a> <!-- Cart -->

                        <!-- Messages -->
                        <a href="{{ route('messages.index') }}" class="text-gray-700 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </a>

                        <!-- Notification Bell -->
                        <div id="notif-bell" x-data="{
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
                        }" x-init="notifications = {{ Js::from(\App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get()) }};"
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
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-20 mt-2 w-72 bg-white shadow-lg rounded-xl overflow-hidden z-50 border border-gray-200">
                                <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                    <span class="text-sm font-semibold text-gray-700">Notifications</span>
                                </div>
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
                            </div>
                        </div>
                    @endif
                @endauth

                @auth

            <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = ! open" class="text-gray-700 flex items-center">
                        <span>{{ Auth::user()->fname }}</span>
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-56 bg-white shadow-lg rounded-md z-50">

                        {{-- Hide Profile and Settings for Admin (role = 2) --}}
                        @if (Auth::user()->role != 2)
                            <a href="{{ route('profile.show', ['user' => Auth::id()]) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                            
                            <!-- Settings Dropdown -->
                            <div x-data="{ settingsOpen: false }" class="relative">
                                <button @click="settingsOpen = !settingsOpen" 
                                    class="w-full text-left flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Settings
                                    </span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': settingsOpen }" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <!-- Settings Submenu -->
                                <div x-show="settingsOpen" @click.away="settingsOpen = false" x-transition
                                    class="absolute right-0 top-0 w-56 bg-white shadow-lg rounded-md border border-gray-200 z-50">
                                    
                                    <!-- Personal Information -->
                                    <div class="px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                        <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide flex items-center gap-2">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Personal Information
                                        </span>
                                    </div>
                                    <a href="{{ route('profile.edit') }}#profile-information" 
                                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200 flex items-center gap-3">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Update Profile Information
                                    </a>
                                    
                                    <!-- Security & Sign-in -->
                                    <div class="px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                        <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide flex items-center gap-2">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Security & Sign-in
                                        </span>
                                    </div>
                                    <a href="{{ route('profile.edit1') }}#update-password" 
                                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200 flex items-center gap-3">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                        Update Password
                                    </a>
                                    
                                    <!-- Data & Privacy -->
                                    <div class="px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                        <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide flex items-center gap-2">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Data & Privacy
                                        </span>
                                    </div>
                                    <a href="{{ route('profile.edit2') }}" 
                                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200 flex items-center gap-3">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        Data & Privacy
                                    </a>
                                   
                                    
                                    <!-- Payment & Subscription -->
                                    <div class="px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                        <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide flex items-center gap-2">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                            Payment & Subscription
                                        </span>
                                    </div>
                                    <a href="{{ route('pricing.index') }}" 
                                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200 flex items-center gap-3">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        Pricing Plans
                                    </a>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-200">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>

                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center bg-[#B59F84] text-white 
        px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[100px]">Sign up</a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center bg-[#B59F84] text-white 
        px-[20px] py-1.5 rounded-[25px] text-base font-semibold 
        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-[100px]">Login</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="flex md:hidden items-center gap-2">
                @auth
                    @if ($role !== 2)
                        <!-- Notification Bell -->
                        <div id="notif-bell" x-data="{
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
                        }" x-init="notifications = {{ Js::from(\App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get()) }};"
                            @new-notification.window="notifications.unshift($event.detail)">
                            <button @click="open = !open; if(open) markAsRead()" class="relative">
                                🔔
                                <span x-show="notifications.filter(n => !n.is_read).length > 0"
                                    class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">
                                    <span x-text="notifications.filter(n => !n.is_read).length"></span>
                                </span>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-20 mt-2 w-72 bg-white shadow-lg rounded-xl overflow-hidden z-50 border border-gray-200">
                                <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                    <span class="text-sm font-semibold text-gray-700">Notifications</span>
                                </div>
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
                            </div>
                        </div>
                    @endif
                @endauth

                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="mt-3 md:hidden">
            <form action="{{ route('search') }}" method="GET"
                class="flex items-center bg-white px-3 py-2 rounded-full shadow-sm border">
                <input type="text" name="query" value="{{ request('query') }}"
                    placeholder="Search for a product..."
                    class="w-full border-none outline-none text-sm bg-transparent text-gray-700" required>
                <button type="submit" class="ml-2 text-gray-500 hover:text-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 1 1 2.83 6.83l3.88 3.88a1 1 0 0 1-1.42 1.42l-3.88-3.88A4 4 0 0 1 8 4zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden mt-2 py-2 bg-gray-100 rounded-lg shadow-md">
            <div class="flex flex-col space-y-2 px-4">
                @auth
                    @if ($role !== 2)
                        <a href="#" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                            <span class="mr-2">🤍</span> Wishlist
                        </a>
                        <a href="#" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                            <span class="mr-2">🛒</span> Cart
                        </a>
                        <a href="{{ route('messages.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.325 0-2.58-.26-3.68-.725L3 20l1.32-3.96C3.474 15.003 3 13.55 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            Messages
                        </a>
                    @endif

                    @if ($role === 0)
                        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Home</a>
                        <a href="{{ route('products.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Sell</a>
                        <a href="{{ route('donations.hub') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Donation Hub</a>
                        <a href="{{ route('appointments.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Upcycle</a>
                    @elseif($role === 1)
                        <a href="{{ route('upcycler.index') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Manage Appointments</a>
                    @endif

                    <a href="{{ route('profile.show', ['user' => Auth::id()]) }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Profile</a>
                    
                    <!-- Mobile Settings Dropdown -->
                    <div x-data="{ mobileSettingsOpen: false }" class="relative">
                        <button @click="mobileSettingsOpen = !mobileSettingsOpen" 
                            class="w-full text-left flex items-center justify-between text-gray-700 py-2 hover:text-red-600">
                            <span>Settings</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': mobileSettingsOpen }" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- Mobile Settings Submenu -->
                        <div x-show="mobileSettingsOpen" x-transition class="ml-4 mt-2 space-y-1">
                            <!-- Personal Information -->
                            <div class="px-2 py-1">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Personal Information</span>
                            </div>
                <a href="{{ route('profile.edit') }}#profile-information" 
                    class="block px-2 py-1 text-sm text-gray-600 hover:text-red-600">
                    Update Profile Information
                </a>
                            
                            <!-- Security & Sign-in -->
                            <div class="px-2 py-1">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Security & Sign-in</span>
                            </div>
                <a href="{{ route('profile.edit1') }}#update-password" 
                    class="block px-2 py-1 text-sm text-gray-600 hover:text-red-600">
                    Update Password
                </a>
                            
                            <!-- Data & Privacy -->
                            <div class="px-2 py-1">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Data & Privacy</span>
                            </div>
                <a href="{{ route('profile.edit2') }}" 
                    class="block px-2 py-1 text-sm text-gray-600 hover:text-red-600">
                    Data & Privacy
                </a>
                            @if (!Auth::user()->is_verified)
                                <a href="{{ route('admin.users.verify', Auth::id()) }}" 
                                    class="block px-2 py-1 text-sm text-blue-600 hover:text-blue-800">
                                    Get Verified
                                </a>
                            @endif
                            
                            <!-- Payment & Subscription -->
                            <div class="px-2 py-1">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Payment & Subscription</span>
                            </div>
                            <a href="{{ route('pricing.index') }}" 
                                class="block px-2 py-1 text-sm text-gray-600 hover:text-red-600">
                                Pricing Plans
                            </a>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center text-gray-700 py-2 hover:text-red-600">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Sign up</a>
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 py-2 hover:text-red-600">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<x-app-layout>
    <div class="py-6 bg-white overflow-hidden dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 flex items-center">
                        {{ Auth::id() === $user->id ? 'My Products' : $user->fname . "'s Products" }}
                        @if ($user->is_verified)
                            <span
                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-1 text-xs font-semibold text-green-700 dark:text-green-200">Verified
                                    User</span>
                            </span>
                        @endif
                    </h2>
                </div>
                @if (Auth::id() === $user->id)
                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center px-5 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                        <span class="mr-2">+</span> List a Product
                    </a>
                @endif
            </div>



            <!-- Profile Information Section -->
            <div class="p-6  mb-8">
                <div class="max-w-6x1 ">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Profile Information</h3>

                    <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-32 bg-center bg-cover"
                            style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">
                            <div class="absolute inset-0 bg-black/20"></div>
                        </div>

                        <!-- User Info Section -->
                        <div class="relative bg-[#E1D5B6] px-6 py-5">
                            <!-- Avatar -->
                            <div
                                class="absolute -top-8 left-[100px] -translate-x-1/2 w-16 h-16 bg-white dark:bg-gray-700 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center z-10">
                                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                    {{ strtoupper(substr($user->fname, 0, 1) . substr($user->lname, 0, 1)) }}
                                </span>
                            </div>

                            <!-- User Details -->
                            <div class="flex items-start justify-between max-w-5xl mx-auto pt-6">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">
                                        {{ $user->fname }} {{ $user->lname }}
                                    </h3>
                                    <!-- Rating -->
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-500">
                                            <span>★★★★★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(5)</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2 ml-4">
                                    <!-- Add Friend Button -->
                                    <a
                                        class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Request
                                    </a>

                                    <!-- Visit Profile Button -->
                                    <a
                                        class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Report
                                    </a>
                                </div>
                            </div>

                            <!-- Report Button (if not the owner) -->
                            @if (Auth::id() !== $user->id)
                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('reports.create', $user->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 9v2m0 4h.01M5.455 4.455a2.836 2.836 0 012-1.455h9.09a2.836 2.836 0 012 1.455l3.182 5.455a2.836 2.836 0 010 2.182L18.545 17.09a2.836 2.836 0 01-2 1.455H7.455a2.836 2.836 0 01-2-1.455L2.273 12.09a2.836 2.836 0 010-2.182L5.455 4.455z" />
                                        </svg>
                                        Report User
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if (Auth::id() !== $user->id)
                    <div class="mt-6 flex flex-col sm:flex-row gap-4">
                        <!-- Report User Button -->
                        <a href="{{ route('reports.create', $user) }}"
                            class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Report User
                        </a>
                        <!-- Review User Button -->
                        <a href="{{ route('reviews.create', $user) }}"
                            class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Review User
                        </a>
                    </div>
                @endif


            </div>
            <!-- Tabs: Products / Reviews -->
            <div class="flex flex-col">
                <div class="mb-6">
                    <div class="inline-flex rounded-full bg-gray-100 dark:bg-gray-800 p-1">
                        <button id="tab-products" type="button"
                            class="px-5 py-2 rounded-full bg-[#E1D5B6] text-gray-800 font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-[#E1D5B6] focus:ring-opacity-50 shadow-md hover:shadow-lg">
                            Products
                        </button>
                        <button id="tab-reviews" type="button"
                            class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100 transition-all duration-300 transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Reviews
                        </button>
                        @if (Auth::id() === $user->id)
                            <button id="tab-orders" type="button"
                                class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100">
                                Orders
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Products Tab -->
                <div id="products" class="overflow-hidden mb-8">

                    <!-- Available Products -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Available Products</h3>
                        @if ($availableProducts->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($availableProducts as $product)
                                    <div
                                        class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-200 border border-gray-200 dark:border-gray-700">
                                        <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                            @if ($product->listingtype === 'for donation')
                                                <div
                                                    class="absolute top-2 left-2 z-10 bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold shadow">
                                                    Donation
                                                </div>
                                            @endif
                                            <div class="relative aspect-square overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->first_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                                <div
                                                    class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                    <span
                                                        class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-medium shadow">
                                                        Quick view
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="p-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h3
                                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <span
                                                        class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                        {{ $product->size ?? 'L' }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mb-2 truncate">
                                                    {{ $product->category->name ?? 'No Category' }}
                                                </p>
                                                <div class="flex justify-between items-center">
                                                    <p
                                                        class="text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-yellow-700' : 'text-red-600' }}">
                                                        {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                    </p>
                                                    <button
                                                        class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors"
                                                        data-id="{{ $product->id }}" type="button"
                                                        onclick="event.preventDefault(); event.stopPropagation();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <x-empty-message message="No active products found." :link="route('products.create')" />
                        @endif
                    </div>

                    <!-- Sold Products -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Sold Products</h3>
                        @if ($soldProducts->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($soldProducts as $product)
                                    <div
                                        class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-200 border border-gray-200 dark:border-gray-700">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="block h-full pointer-events-none opacity-70">
                                            <!-- Sold Badge -->
                                            <div
                                                class="absolute top-2 left-2 z-20 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow">
                                                Sold
                                            </div>

                                            <!-- Donation Badge -->
                                            @if ($product->listingtype === 'for donation')
                                                <div
                                                    class="absolute top-2 right-2 z-10 bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold shadow">
                                                    Donation
                                                </div>
                                            @endif

                                            <div class="relative aspect-square overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->first_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 filter brightness-75">
                                                <div
                                                    class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                                    <span
                                                        class="bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-medium shadow">
                                                        Quick view
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="p-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h3
                                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors truncate max-w-[70%]">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <span
                                                        class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                        {{ $product->size ?? 'L' }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mb-2 truncate">
                                                    {{ $product->category->name ?? 'No Category' }}
                                                </p>
                                                <div class="flex justify-between items-center">
                                                    <p
                                                        class="text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-yellow-700' : 'text-red-600' }}">
                                                        {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 0) }}
                                                    </p>
                                                    <button
                                                        class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors"
                                                        data-id="{{ $product->id }}" type="button"
                                                        onclick="event.preventDefault(); event.stopPropagation();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No sold products yet.</p>
                        @endif
                    </div>

                </div>

                <!-- Reviews Received -->
                <div id="reviews" class="hidden overflow-hidden mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reviews Received</h3>
                    @forelse($user->reviewsReceived as $review)
                        <div
                            class="mb-6 p-4 border dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-700 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $review->reviewer->fname ?? 'Anonymous' }}
                                </div>
                                <div class="flex space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.362 4.197a1 1 0 00.95.69h4.417c.969 0 1.371 1.24.588 1.81l-3.58 2.601a1 1 0 00-.364 1.118l1.362 4.197c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.58 2.601c-.784.57-1.838-.197-1.539-1.118l1.362-4.197a1 1 0 00-.364-1.118L2.3 9.624c-.782-.57-.38-1.81.588-1.81h4.418a1 1 0 00.949-.69l1.362-4.197z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            @if ($review->comment)
                                <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                    {{ $review->comment }}
                                </p>
                            @endif
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Reviewed on {{ $review->created_at->format('F j, Y') }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">No reviews received yet.</p>
                    @endforelse
                </div>

                <!-- Orders Section -->
                <div id="orders" class="hidden overflow-hidden mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Orders</h3>

                    @if ($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Order ID</th>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Product</th>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Buyer</th>

                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Status</th>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                #{{ $order->id }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $order->product->name }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">
                                                {{ $order->buyer->fname }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs font-medium
                                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'approved') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'delivering') bg-purple-100 text-purple-800
                                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200 space-x-1">
                                                @if ($order->status === 'pending')
                                                    <form
                                                        action="{{ route('orders.updateStatus', [$order->id, 'approved']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-green-600 text-white rounded">Approve</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('orders.updateStatus', [$order->id, 'cancelled']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-red-600 text-white rounded">Cancel</button>
                                                    </form>
                                                @elseif($order->status === 'approved')
                                                    <form
                                                        action="{{ route('orders.updateStatus', [$order->id, 'delivering']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-blue-600 text-white rounded">Mark
                                                            as Delivering</button>
                                                    </form>
                                                @elseif($order->status === 'delivering')
                                                    <form
                                                        action="{{ route('orders.updateStatus', [$order->id, 'completed']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs bg-purple-600 text-white rounded">Mark
                                                            as Completed</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No orders yet.</p>
                    @endif
                </div>

            </div>
            <style>
                html {
                    scroll-behavior: smooth;
                }

                /* Smooth transition for tab switching */
                #tab-products,
                #tab-reviews {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }

                /* Active state animation */
                #tab-products.active,
                #tab-reviews.active {
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                }

                /* Pulse animation on click */
                @keyframes pulse {
                    0% {
                        transform: scale(1);
                    }

                    50% {
                        transform: scale(0.95);
                    }

                    100% {
                        transform: scale(1);
                    }
                }

                .button-click {
                    animation: pulse 0.3s ease-in-out;
                }
            </style>
            <script>
                (function() {
                    const productsTab = document.getElementById('tab-products');
                    const reviewsTab = document.getElementById('tab-reviews');
                    const ordersTab = document.getElementById('tab-orders');

                    const products = document.getElementById('products');
                    const reviews = document.getElementById('reviews');
                    const orders = document.getElementById('orders');

                    function activate(tab) {
                        const isProducts = tab === 'products';
                        const isReviews = tab === 'reviews';
                        const isOrders = tab === 'orders';

                        products.classList.toggle('hidden', !isProducts);
                        reviews.classList.toggle('hidden', !isReviews);
                        orders.classList.toggle('hidden', !isOrders);

                        [productsTab, reviewsTab, ordersTab].forEach(btn => {
                            btn.classList.remove('bg-[#E1D5B6]', 'font-semibold', 'shadow-md');
                        });

                        const activeTab = tab === 'products' ? productsTab : (tab === 'reviews' ? reviewsTab : ordersTab);
                        activeTab.classList.add('bg-[#E1D5B6]', 'font-semibold', 'shadow-md');

                        const target = tab === 'products' ? products : (tab === 'reviews' ? reviews : orders);
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }

                    productsTab.addEventListener('click', () => activate('products'));
                    reviewsTab.addEventListener('click', () => activate('reviews'));
                    if (ordersTab) ordersTab.addEventListener('click', () => activate('orders'));

                    activate('products'); // default
                })();
            </script>

</x-app-layout>

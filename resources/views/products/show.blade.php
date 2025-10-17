<x-app-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto p-6">
            <!-- Two-Column Layout -->
            <div class="flex flex-col lg:flex-row gap-8 items-stretch">
                <!-- Left Column: Image Slider & Product Info -->
                <div class="lg:w-1/3 flex flex-col gap-6 h-full">
                    <!-- Swiper Slider -->
                    <div class="relative swiper mySwiper rounded-xl overflow-hidden shadow-lg h-[28rem] sm:h-[32rem]">
                        <div class="swiper-wrapper h-full">
                            @if ($product->images && $product->images->count() > 0)
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide flex items-center justify-center bg-white h-full">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-105">
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback placeholder if no images -->
                                <div class="swiper-slide flex items-center justify-center bg-white h-full">
                                    <img src="{{ asset('images/default-placeholder.png') }}" alt="No image"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                        </div>

                        <!-- Swiper Pagination (overlay) -->
                        <div class="swiper-pagination absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10"></div>
                        <!-- Swiper Navigation -->
                        <div
                            class="swiper-button-next !text-white text-3xl z-20 hover:!text-gray-200 transition-colors duration-300">
                        </div>
                        <div
                            class="swiper-button-prev !text-white text-3xl z-20 hover:!text-gray-200 transition-colors duration-300">
                        </div>
                    </div>
                    <!-- Product Info Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $product->name }}
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Size: {{ $product->size }} ·
                            {{ ucfirst($product->condition) }} ·
                            {{ $product->category->name ?? 'No Category' }}
                        </p>
                        <div class="space-y-4 mt-4">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Details</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $product->status }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ $product->description }}</p>

                        </div>
                        @if ($product->listingtype === 'for donation')
                            <p class="text-lg font-bold text-green-500 dark:text-green-400">For Donation</p>
                        @else
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                ₱{{ number_format($product->price, 2) }}</p>
                        @endif
                        <p class="text-sm text-gray-500 dark:text-gray-400">Quantity: {{ $product->qty }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status: {{ ucfirst($product->status) }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Location: {{ $product->barangay->name ?? 'N/A' }}, Cebu City, Cebu 6000
                        </p>

                        <!-- Show Update Button if User Owns the Product -->
                        @if (Auth::id() === $product->user_id)
                            <div class="flex flex-col gap-3 mt-4">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="px-6 py-3 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition-all duration-300 text-center font-medium">
                                    Update Product
                                </a>
                                @if ($product->status === 'available')
                                    <form action="{{ route('products.markAsSold', $product) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="w-full px-6 py-3 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800 transition-all duration-300 font-medium"
                                            onclick="return confirm('Mark this product as Sold?')">
                                            Mark as Sold
                                        </button>
                                    </form>
                                @else
                                    <button type="button" disabled
                                        class="w-full px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-lg cursor-not-allowed font-medium">
                                        Item Marked as Sold
                                    </button>
                                @endif
                            </div>
                        @endif
                        <!-- Wrap both button + modal inside the same x-data -->
                        <div x-data="{ open: false }">
                            @php
                                $existingOrder = $product->orders()->where('buyer_id', Auth::id())->first();
                            @endphp

                            <!-- Buy Now Button -->
                            @if ($product->listingtype !== 'for donation' && Auth::id() !== $product->user_id && (!$existingOrder || $existingOrder->status === 'cancelled'))
                                @if ($product->qr_code)
                                    <button type="button" @click="open = true"
                                        class="w-full mt-4 px-6 py-3 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition-all duration-300 font-medium">
                                        Buy Now
                                    </button>
                                @else
                                    <button type="button" disabled
                                        class="w-full mt-4 px-6 py-3 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed font-medium">
                                        Buy Now (Unavailable - No QR Code)
                                    </button>
                                @endif
                            @endif

                          <!-- Enhanced Payment Modal -->
<div x-show="open" x-transition
    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden relative">
        <!-- Header with Gradient Background -->
        <div class="bg-gradient-to-r from-[#B59F84] to-[#8A7B66] p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Complete Your Purchase</h2>
                        <p class="text-white/80 text-sm">Secure payment process</p>
                    </div>
                </div>
                <button type="button" @click="open = false; clearFileInput()"
                    class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Progress Steps - UPDATED -->
        <div class="px-6 pt-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-[#B59F84] rounded-full flex items-center justify-center text-white text-sm font-bold">
                        1
                    </div>
                    <span class="text-xs text-gray-600 mt-1">Scan QR</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-2">
                    <div class="h-1 bg-[#B59F84] transition-all duration-300" id="progress-line"></div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-bold transition-all duration-300" id="step-2-circle">
                        2
                    </div>
                    <span class="text-xs text-gray-600 mt-1">Upload Proof</span>
                </div>
            </div>
        </div>

        <!-- Content - Scrollable -->
        <div class="p-6 max-h-96 overflow-y-auto">
            <!-- QR Code Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 bg-[#F8EED6] rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3 text-[#634600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Scan to Pay</h3>
                </div>
                
                <div class="bg-gradient-to-br from-[#F8EED6] to-[#F4F2ED] rounded-xl p-4 mb-4">
                    <p class="text-sm text-[#603E14] mb-3 text-center">
                        Use your mobile banking app to scan this QR code
                    </p>
                    <div class="flex justify-center">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $product->qr_code) }}" alt="QR Code"
                                class="w-48 h-48 object-contain border-4 border-white rounded-lg shadow-md">
                            <div class="absolute inset-0 border-2 border-dashed border-[#B59F84] rounded-lg animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-medium text-gray-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-[#634600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        How to Pay:
                    </h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center">
                            <svg class="w-3 h-3 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Open your banking/mobile wallet app
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3 h-3 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Tap "Scan QR" or "Pay with QR"
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3 h-3 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Point camera at this QR code
                        </li>
                        <li class="flex items-center">
                            <svg class="w-3 h-3 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Confirm the payment amount
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Upload Proof Section -->
            <form id="payment-form" action="{{ route('orders.store', $product->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div class="border-t pt-6">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-6 h-6 bg-[#F8EED6] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-[#634600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Upload Payment Proof</h3>
                    </div>

                    <!-- File Upload Area -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Upload screenshot or photo of your payment confirmation
                        </label>
                        
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#B59F84] transition-colors duration-200"
                             id="dropZone">
                            <input type="file" name="proof" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                   id="fileInput" required>
                            
                            <div class="space-y-2">
                                <div class="w-12 h-12 bg-[#F8EED6] rounded-full flex items-center justify-center mx-auto">
                                    <svg class="w-6 h-6 text-[#634600]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="text-[#634600] font-medium">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- File Preview -->
                        <div id="filePreview" class="hidden mt-3">
                            <div class="flex items-center space-x-3 bg-green-50 rounded-lg p-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-green-700" id="fileName">File selected</span>
                            </div>
                        </div>
                    </div>

                    <!-- Security Features -->
                    <div class="bg-blue-50 rounded-lg p-4 mb-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-1">Secure & Protected</h4>
                                <p class="text-xs text-blue-600">
                                    Your payment information is encrypted and secure. We use industry-standard security measures to protect your data.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Action Buttons - Fixed at Bottom -->
        <div class="bg-white border-t border-gray-200 p-6">
            <div class="flex justify-end space-x-3">
                <!-- Update your cancel button in the modal -->
                <button type="button" @click="open = false; clearFileInput()"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium">
                    Cancel
                </button>
                <button type="submit" form="payment-form"
                    class="px-6 py-3 bg-gradient-to-r from-[#B59F84] to-[#8A7B66] text-white rounded-xl hover:from-[#a08e77] hover:to-[#78695a] transform hover:scale-105 transition-all duration-200 font-medium shadow-md flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Submit Proof</span>
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t">
            <div class="flex items-center justify-center space-x-6 text-xs text-gray-500">
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <span>Secure Payment</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span>Trusted Seller</span>
                </div>
            </div>
        </div>
    </div>
</div>
                        </div>
                        <!-- End of x-data Modal Wrapper -->


                    </div>
                </div>
                <!-- Right Column: User Info, Comments -->
                <div class="lg:w-2/3 flex flex-col gap-8">
                    <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-36 bg-center bg-cover"
                            style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/30"></div>
                        </div>

                        <!-- User Info Section -->
                        <div class="relative bg-[#E1D5B6] dark:bg-gray-800 p-6">
                            <!-- Avatar -->
                            <div
                                class="absolute -top-10 left-6 w-20 h-20 bg-[#B59F84] rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center shadow-md">
                                <span class="text-2xl font-bold text-white">
                                    {{ strtoupper(substr($product->user->fname, 0, 1) . substr($product->user->lname, 0, 1)) }}
                                </span>
                            </div>

                            <!-- User Details -->
                            <div class="flex items-start justify-between pt-10">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 dark:text-white text-xl">
                                        {{ $product->user->fname }} {{ $product->user->lname }}
                                    </h3>
                                    <!-- Rating -->
                                    <div class="flex items-center mt-2">
                                        <div class="flex text-yellow-400">
                                            <span>★★★★★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">(5)</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-3 ml-4">
                                    <a href="{{ route('private.chat', $product->user->id) }}"
                                        class="px-5 py-2.5 bg-white dark:bg-gray-700 text-[#B59F84] dark:text-[#E1D5B6] rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300 text-sm font-medium">
                                        Message
                                    </a>
                                    <a href="{{ route('profile.show', $product->user->id) }}"
                                        class="px-5 py-2.5 bg-white dark:bg-gray-700 text-[#B59F84] dark:text-[#E1D5B6] rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300 text-sm font-medium">
                                        Visit Profile
                                    </a>
                                </div>
                            </div>

                            <!-- Report Button (if not the owner) -->
                            @if (Auth::id() !== $product->user_id)
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('reports.create', $product->user->id) }}"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-sm text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
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



                    <!-- Comments Section -->
                    <div class="bg-[#F4F2ED] dark:bg-gray-800   rounded-xl p-10 shadow-md">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Comments</h3>

                    <!-- Scrollable Comment List -->
                    <div id="comments-container" class="space-y-4 max-h-80 overflow-y-auto pr-2">
                        @forelse($product->comments as $comment)
                            <!-- Comment Item -->
                            <div class="comment-item bg-white dark:bg-gray-700 rounded-lg p-4 shadow-sm" data-comment-id="{{ $comment->id }}" id="comment-{{ $comment->id }}">
                                <div class="flex gap-3">
                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-[#B59F84] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                            <span class="text-sm font-bold text-white">
                                                {{ strtoupper(substr($comment->user->fname, 0, 1) . substr($comment->user->lname, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Comment Content -->
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-1">
                                            <div>
                                                <a href="{{ route('profile.show', $comment->user->id) }}" class="font-semibold text-gray-800 dark:text-gray-200 hover:underline">
                                                    {{ $comment->user->fname }} {{ $comment->user->lname }}
                                                </a>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            
                                            <!-- Comment Options (for comment owner) -->
                                            @if(Auth::id() === $comment->user_id)
                                                <div class="relative">
                                                    <button type="button" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-600" onclick="toggleDropdown({{ $comment->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </button>
                                                    <div id="dropdown-{{ $comment->id }}" class="absolute right-0 mt-1 w-28 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow z-10 hidden">
                                                        <button type="button" onclick="toggleEditForm({{ $comment->id }})" class="w-full text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                            Edit
                                                        </button>
                                                        <button type="button" onclick="deleteComment({{ $comment->id }})" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div id="comment-content-{{ $comment->id }}" class="text-gray-800 dark:text-gray-200 mb-2">
                                            {{ $comment->content }}
                                        </div>
                                        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                            <button onclick="toggleLike({{ $comment->id }})" class="flex items-center gap-1 hover:text-[#B59F84] transition-colors duration-200 {{ $comment->userLikes->count() > 0 ? 'text-[#B59F84]' : 'text-gray-500' }}" id="like-btn-{{ $comment->id }}">
                                                <svg class="w-4 h-4" fill="{{ $comment->userLikes->count() > 0 ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                                <span id="like-count-{{ $comment->id }}">{{ $comment->likes_count }}</span>
                                            </button>
                                            <button onclick="toggleReplyForm({{ $comment->id }})" class="flex items-center gap-1 hover:text-[#B59F84] transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                Reply
                                            </button>
                                            @if($comment->replies_count > 0)
                                                <button onclick="toggleReplies({{ $comment->id }})" class="text-[#B59F84] hover:underline">
                                                    {{ $comment->replies_count }} {{ $comment->replies_count == 1 ? 'reply' : 'replies' }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Edit Form (Hidden by Default) -->
                                @if(Auth::id() === $comment->user_id)
                                    <form id="inline-edit-form-{{ $comment->id }}" action="{{ route('comments.update', $comment->id) }}" method="POST" class="inline-edit-form hidden mt-2 bg-gray-100 dark:bg-gray-600 p-3 rounded-lg" data-id="{{ $comment->id }}">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="content" rows="2" class="w-full border rounded p-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">{{ old('content', $comment->content) }}</textarea>
                                        <div class="flex gap-2 mt-2">
                                            <button type="submit" class="px-3 py-1 bg-[#B59F84] text-white rounded text-sm hover:bg-[#a08e77] transition-all duration-200">Save</button>
                                            <button type="button" onclick="cancelEdit({{ $comment->id }})" class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 text-sm">Cancel</button>
                                        </div>
                                    </form>
                                @endif
                                
                                <!-- Reply Form (Hidden by Default) -->
                                <div id="reply-form-{{ $comment->id }}" class="hidden mt-3 ml-4">
                                    <form class="reply-form" data-parent-id="{{ $comment->id }}">
                                        @csrf
                                        <div class="flex gap-2">
                                            <textarea name="content" placeholder="Write a reply..." class="flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:bg-gray-700 dark:text-white" rows="2" required></textarea>
                                            <div class="flex flex-col gap-2">
                                                <button type="submit" class="px-3 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition-all duration-200 text-sm">
                                                    Reply
                                                </button>
                                                <button type="button" onclick="toggleReplyForm({{ $comment->id }})" class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200 text-sm">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </form>
                                </div>
                                
                                <!-- Replies Container (Hidden by Default) -->
                                <!-- Replies Container -->
                                <div id="replies-{{ $comment->id }}" 
     class="hidden ml-4 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4">
    @foreach($comment->replies as $reply)
        <div class="reply-item flex gap-3" data-comment-id="{{ $reply->id }}" id="reply-{{ $reply->id }}">
            
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-[#B59F84] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                    <span class="text-xs font-bold text-white">
                        {{ strtoupper(substr($reply->user->fname, 0, 1) . substr($reply->user->lname, 0, 1)) }}
                    </span>
                </div>
            </div>

                                                <!-- Reply Content -->
                                                <div class="flex-1">
                                                    <div>
                                                        <a href="{{ route('profile.show', $reply->user->id) }}"
                                                            class="text-sm font-semibold text-gray-800 dark:text-gray-200 hover:underline">
                                                            {{ $reply->user->fname }} {{ $reply->user->lname }}
                                                        </a>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                                                            {{ $reply->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>

                                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $reply->content }}</p>

                                                    <!-- Actions -->
                                                    <div
                                                        class="mt-2 flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                                        <button onclick="toggleLike({{ $reply->id }})"
                                                            class="flex items-center gap-1 hover:text-[#B59F84] transition-colors duration-200 {{ $reply->userLikes->count() > 0 ? 'text-[#B59F84]' : 'text-gray-500' }}"
                                                            id="like-btn-{{ $reply->id }}">
                                                            <svg class="w-3 h-3"
                                                                fill="{{ $reply->userLikes->count() > 0 ? 'currentColor' : 'none' }}"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                                </path>
                                                            </svg>
                                                            <span
                                                                id="like-count-{{ $reply->id }}">{{ $reply->likes_count }}</span>
                                                        </button>

                    <!-- Reply button -->
                    <button onclick="toggleReplyForm({{ $reply->id }})" 
                            class="hover:text-[#B59F84] transition-colors duration-200">
                        Reply
                    </button>
                </div>

                <!-- Reply Form -->
                <div id="reply-form-{{ $reply->id }}" class="hidden mt-2 ml-8">
                    <form class="reply-form" data-parent-id="{{ $reply->id }}">
                        @csrf
                        <div class="flex gap-2">
                            <textarea name="content" placeholder="Write a reply..."
                                      class="flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none 
                                             focus:ring-2 focus:ring-[#B59F84] focus:border-transparent 
                                             dark:bg-gray-700 dark:text-white"
                                      rows="2" required></textarea>
                            <button type="submit" 
                                    class="px-3 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] 
                                           transition-all duration-200 text-sm">
                                Reply
                            </button>
                        </div>
                        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </form>
                </div>

                                                    <!-- Nested Replies Container for this reply -->
                                                    <div id="replies-{{ $reply->id }}"
                                                        class="hidden ml-8 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-400 text-sm py-4 text-center">No comments yet.
                                    Be the first to comment!</p>
                            @endforelse
                        </div>

                        <!-- Comment Form -->
                        @auth
                            <form id="comment-form" action="{{ route('comments.store') }}" method="POST"
                                class="mt-6">
                                @csrf
                                <div
                                    class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full max-w-xl bg-white dark:bg-gray-800 p-3 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-md">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <textarea name="content" id="comment-content" placeholder="Write a comment..."
                                        class="flex-1 w-full resize-none overflow-hidden rounded-lg px-4 py-2 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#B59F84] border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700"
                                        rows="2" oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px';" required></textarea>
                                    <button type="submit"
                                        class="mt-2 md:mt-0 md:self-center bg-[#B59F84] text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-[#a08e77] transition-all duration-300 ease-in-out w-full md:w-auto">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                                <div id="comment-error" class="text-red-500 mt-2 text-sm hidden"></div>
                            </form>
                        @else
                            <p class="mt-3 text-gray-600 dark:text-gray-400">
                                <a href="{{ route('login') }}" class="text-[#B59F84] hover:underline">Login</a> to
                                comment.
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- More Products from the Same User -->
    @if ($moreProducts->count())
        <div class="py-6 bg-white dark:bg-gray-900 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                        More from {{ $product->user->fname }}
                    </h2>
                </div>
                <div class="rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div
                            class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6">
                            @foreach ($moreProducts as $product)
                                <div
                                    class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-200 border border-[#D9D9D9] dark:border-gray-700">
                                    <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                        @if ($product->listingtype === 'for donation')
                                            <div
                                                class="absolute top-1 left-1 z-10 bg-[#D9D9D9] text-gray-700 text-[10px] sm:text-xs px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full">
                                                Donation
                                            </div>
                                        @endif

                                        <div class="relative aspect-square overflow-hidden">
                                            <img src="{{ asset('storage/' . $product->first_image) }}"
                                                alt="{{ $product->name }}" class="w-full h-full object-cover">

                                            <div
                                                class="absolute inset-0 bg-gray-800 bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">

                                            </div>
                                        </div>

                                        <div class="p-2 sm:p-3">
                                            <div class="flex justify-between items-start">
                                                <h3
                                                    class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white transition-colors truncate max-w-[70%]">
                                                    {{ $product->name }}
                                                </h3>
                                                <span
                                                    class="text-[10px] sm:text-xs font-medium px-1 py-0.5 bg-[#D9D9D9] dark:bg-gray-700 rounded text-gray-700 dark:text-gray-300">
                                                    {{ $product->size ?? 'L' }}
                                                </span>
                                            </div>

                                            <p
                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                {{ $product->category->name ?? 'No Category' }}
                                            </p>
                                            <p
                                                class="text-gray-500 dark:text-gray-400 text-[10px] sm:text-xs mt-0.5 truncate">
                                                <i>{{ $product->barangay->name ?? 'N/A' }}, Cebu City</i>
                                            </p>

                                            <div class="flex justify-between items-center mt-1">
                                                <p
                                                    class="text-xs sm:text-sm font-bold {{ $product->listingtype === 'for donation' ? 'text-gray-700' : 'text-black-600' }}">
                                                    {{ $product->listingtype === 'for donation' ? 'For Donation' : '₱' . number_format($product->price, 2) }}
                                                </p>
                                                <button
                                                    class="favorite-btn text-gray-400 hover:text-red-500 focus:outline-none transition-colors"
                                                    data-id="{{ $product->id }}" type="button"
                                                    onclick="event.preventDefault(); event.stopPropagation();">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
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
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-6 bg-white dark:bg-gray-900 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center p-6 border border-dashed border-gray-300 dark:border-gray-700 rounded-xl">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        No other products from <strong>{{ $product->user->fname }}</strong> yet.
                    </p>
                </div>
            </div>
        </div>
    @endif
    </div>
    </div>



    <script>
        // Add this function to update the progress bar
        function updateProgressBar() {
            const fileInput = document.getElementById('fileInput');
            const step2Circle = document.getElementById('step-2-circle');
            const progressLine = document.getElementById('progress-line');
            
            if (fileInput && fileInput.files.length > 0) {
                // File is uploaded - complete step 2
                step2Circle.classList.remove('bg-gray-200', 'text-gray-500');
                step2Circle.classList.add('bg-[#B59F84]', 'text-white');
                progressLine.classList.add('w-full');
            } else {
                // No file - reset step 2
                step2Circle.classList.remove('bg-[#B59F84]', 'text-white');
                step2Circle.classList.add('bg-gray-200', 'text-gray-500');
                progressLine.classList.remove('w-full');
            }
        }

        function clearFileInput() {
            const fileInput = document.getElementById('fileInput');
            const filePreview = document.getElementById('filePreview');
            const dropZone = document.getElementById('dropZone');
            
            // Clear the file input
            if (fileInput) fileInput.value = '';
            
            // Hide the file preview
            if (filePreview) filePreview.classList.add('hidden');
            
            // Reset drop zone styling
            if (dropZone) {
                dropZone.classList.remove('border-green-500', 'bg-green-50');
                dropZone.classList.remove('border-[#B59F84]', 'bg-[#F8EED6]');
            }
            
            // Update progress bar
            updateProgressBar();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const dropZone = document.getElementById('dropZone');
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');

            // Handle file selection
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        const file = e.target.files[0];
                        if (fileName) fileName.textContent = file.name;
                        if (filePreview) filePreview.classList.remove('hidden');
                        if (dropZone) dropZone.classList.add('border-green-500', 'bg-green-50');
                        
                        // Update progress bar when file is selected
                        updateProgressBar();
                    }
                });
            }

            // Drag and drop functionality
            if (dropZone) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, unhighlight, false);
                });

                function highlight() {
                    dropZone.classList.add('border-[#B59F84]', 'bg-[#F8EED6]');
                }

                function unhighlight() {
                    dropZone.classList.remove('border-[#B59F84]', 'bg-[#F8EED6]');
                }

                dropZone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    if (fileInput) fileInput.files = files;
                    
                    if (files.length > 0) {
                        const file = files[0];
                        if (fileName) fileName.textContent = file.name;
                        if (filePreview) filePreview.classList.remove('hidden');
                        if (dropZone) dropZone.classList.add('border-green-500', 'bg-green-50');
                        
                        // Update progress bar when file is dropped
                        updateProgressBar();
                    }
                }
            }

            // Add event listeners to clear file input when modal is closed
            const modal = document.querySelector('[x-show="open"]');
            const cancelButtons = document.querySelectorAll('button[type="button"][@click*="open = false"]');
            
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Small delay to ensure modal is closed before clearing
                    setTimeout(clearFileInput, 300);
                });
            });

            // Also clear when clicking outside the modal (backdrop)
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        setTimeout(clearFileInput, 300);
                    }
                });
            }
            
            // Initialize progress bar
            updateProgressBar();
        });

        // Rest of your existing JavaScript functions remain the same...
        function toggleDropdown(commentId) {
            const dropdown = document.getElementById('dropdown-' + commentId);
            if (dropdown.classList.contains('hidden')) {
                // Close all other dropdowns first
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                // Open this dropdown
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest(
                '[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".mySwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });

        // JavaScript to expand comments on hover
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.comment-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    const lineClamp = this.querySelector('.line-clamp-3');
                    if (lineClamp) {
                        lineClamp.style['-webkit-line-clamp'] = 'unset';
                        lineClamp.style.display = 'block';
                    }
                });

                item.addEventListener('mouseleave', function() {
                    const lineClamp = this.querySelector('.line-clamp-3');
                    if (lineClamp) {
                        lineClamp.style['-webkit-line-clamp'] = '3';
                        lineClamp.style.display = '-webkit-box';
                    }
                });
            });
        });

        // Your other JavaScript functions remain the same
        function toggleDropdown(commentId) {
            const dropdown = document.getElementById('dropdown-' + commentId);
            if (dropdown.classList.contains('hidden')) {
                // Close all other dropdowns first
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                // Open this dropdown
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest(
                '[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });

        function toggleEditForm(commentId) {
            const contentDiv = document.getElementById(`comment-content-${commentId}`);
            const form = document.getElementById(`inline-edit-form-${commentId}`);
            const dropdown = document.getElementById(`dropdown-${commentId}`);

            if (dropdown) dropdown.classList.add('hidden'); // hide dropdown when editing
            contentDiv.classList.toggle('hidden');
            form.classList.toggle('hidden');
        }

        function cancelEdit(commentId) {
            const contentDiv = document.getElementById(`comment-content-${commentId}`);
            const form = document.getElementById(`inline-edit-form-${commentId}`);

            contentDiv.classList.remove('hidden');
            form.classList.add('hidden');
        }

        function deleteComment(commentId) {
            // Confirm deletion


            console.log('Attempting to delete comment with ID:', commentId);

            // Debug: List all comments and their IDs
            const allComments = document.querySelectorAll('.comment-item');
            console.log('All comments in DOM:');
            allComments.forEach((comment, index) => {
                console.log(`Comment ${index}:`, {
                    id: comment.id,
                    dataId: comment.getAttribute('data-comment-id'),
                    text: comment.textContent.substring(0, 50) + '...'
                });
            });

            fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Delete response:', data);
                    if (data.success) {
                        // Find the specific comment element - be more specific to avoid conflicts
                        const commentElement = document.getElementById(`comment-${commentId}`) || document
                            .querySelector(`.comment-item[data-comment-id="${commentId}"]`);
                        const replyElement = document.querySelector(`.reply-item[data-comment-id="${commentId}"]`);

                        console.log('Found comment element:', commentElement);
                        console.log('Found reply element:', replyElement);

                        const elementToRemove = commentElement || replyElement;

                        if (elementToRemove) {
                            console.log('Removing element:', elementToRemove);
                            // Remove the entire comment/reply element
                            elementToRemove.remove();

                            // Check if there are any remaining comments
                            const remainingComments = document.querySelectorAll('.comment-item');
                            console.log('Remaining comments:', remainingComments.length);
                            if (remainingComments.length === 0) {
                                // Show "no comments" message if no comments left
                                const container = document.getElementById('comments-container');
                                container.innerHTML =
                                    '<p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>';
                            }
                        } else {
                            console.error('Comment element not found for ID:', commentId);
                            alert('Comment not found. Please refresh the page.');
                        }
                    } else {
                        alert('Failed to delete comment: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error deleting comment:', error);
                    alert('Something went wrong while deleting the comment.');
                });
        }

        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                // Add cache-busting parameter and reload
                const url = new URL(window.location);
                url.searchParams.set('_t', Date.now());
                window.location.href = url.toString();
            }
        });

// Force refresh on back/forward navigation
window.addEventListener("popstate", function (event) {
    const url = new URL(window.location);
    url.searchParams.set('_t', Date.now());
    window.location.href = url.toString();
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".inline-edit-form").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('_method', 'PUT'); // Important!

            let commentId = this.dataset.id;
            let url = this.action;

            fetch(url, {
                method: "POST", // Still POST, Laravel sees _method=PUT
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // ✅ Update the DOM immediately
                    const contentDiv = document.getElementById("comment-content-" + commentId);
                    contentDiv.innerText = data.comment.content;

                    this.classList.add("hidden");
                    contentDiv.classList.remove("hidden");
                } else {
                    alert(data.error || "Failed to update comment.");
                }
            })
            .catch(error => {
                console.error("Error updating comment:", error);
                alert("Something went wrong while updating the comment.");
            });
        });
    });
});

        // Optional: Add JavaScript to expand comments on hover/click
        document.querySelectorAll('.comment-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.querySelector('.line-clamp-3').style['-webkit-line-clamp'] = 'unset';
            });

            item.addEventListener('mouseleave', function() {
                this.querySelector('.line-clamp-3').style['-webkit-line-clamp'] = '3';
            });
        });
        // AJAX comment submission
        document.addEventListener('DOMContentLoaded', function() {
            const commentForm = document.getElementById('comment-form');
            if (commentForm) {
                commentForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const errorDiv = document.getElementById('comment-error');
                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;

                    // Show loading state
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    submitButton.disabled = true;
                    errorDiv.classList.add('hidden');

                    fetch("{{ route('comments.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(async (response) => {
                            const contentType = response.headers.get('content-type') || '';
                            if (!response.ok) {
                                if (contentType.includes('application/json')) {
                                    const errorData = await response.json();
                                    const msg = errorData.message || errorData.errors?.content?.[
                                        0] || 'Error';
                                    throw new Error(msg);
                                } else {
                                    throw new Error('Request failed (maybe login required).');
                                }
                            }
                            if (!contentType.includes('application/json')) {
                                throw new Error('Unexpected response from server.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Clear the textarea
                                document.getElementById('comment-content').value = '';

                                // Add the new comment to the list
                                addCommentToDOM(data.comment);

                                // If there was a "no comments" message, remove it
                                const noCommentsMsg = document.querySelector('#comments-container > p');
                                if (noCommentsMsg) {
                                    noCommentsMsg.remove();
                                }
                            } else {
                                throw new Error(data.message || 'An error occurred');
                            }
                        })
                        .catch(error => {
                            errorDiv.textContent = error.message ||
                                'Failed to post comment. Please try again.';
                            errorDiv.classList.remove('hidden');
                        })
                        .finally(() => {
                            submitButton.innerHTML = originalButtonText;
                            submitButton.disabled = false;
                        });
                });
            }
        });


        function addCommentToDOM(commentData) {
            // ✅ If this is a reply
            if (commentData.parent_id) {
                let repliesContainer = document.getElementById(`replies-${commentData.parent_id}`);

                // If no replies container yet, create one
                if (!repliesContainer) {
                    const parentComment = document.getElementById(`comment-${commentData.parent_id}`) || document
                        .getElementById(`reply-${commentData.parent_id}`);
                    if (parentComment) {
                        repliesContainer = document.createElement('div');
                        repliesContainer.id = `replies-${commentData.parent_id}`;
                        repliesContainer.className =
                            "ml-8 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4";
                        parentComment.appendChild(repliesContainer);
                    }
                }

                // prevent duplicate
                if (document.getElementById(`reply-${commentData.id}`)) {
                    return;
                }

                const replyHtml = `
        <div class="reply-item flex gap-3" id="reply-${commentData.id}">
            <div class="w-8 h-8 bg-[#B59F84] rounded-full flex items-center justify-center">
                <span class="text-xs font-bold text-white">
                    ${(commentData.user.fname.charAt(0) + commentData.user.lname.charAt(0)).toUpperCase()}
                </span>
            </div>
            <div class="flex-1">
                <p class="font-medium">${commentData.user.fname} ${commentData.user.lname}</p>
                <p>${commentData.content}</p>
                <button onclick="toggleReplyForm(${commentData.id})" class="text-xs text-gray-500 hover:text-[#B59F84]">Reply</button>
                <div id="reply-form-${commentData.id}" class="hidden mt-3 ml-4">
                    <form class="reply-form" data-parent-id="${commentData.id}">
                    <div class="flex gap-2">
                        <textarea name="content" class="w-full border rounded p-2"  class="flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:bg-gray-700 dark:text-white" rows="2" required></textarea>
                       <div class="flex flex-col gap-2">
                      
                        <button type="submit" class="px-3 py-1 bg-[#B59F84] text-white rounded text-sm mt-1">Reply</button>
                        <button type="button" onclick="toggleReplyForm(${commentData.id})" class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 text-sm">Cancel</button>
                        
                      </div>
                    </div>
                      <input type="hidden" name="parent_id" value="${commentData.id}">
                      <input type="hidden" name="product_id" value="${commentData.product_id}">
                        </form>
                </div>
            </div>
        </div>
    `;
                repliesContainer.insertAdjacentHTML('beforeend', replyHtml);
                return;
            }


            // ✅ Otherwise, this is a top-level comment
            const commentsContainer = document.getElementById('comments-container');

            if (document.getElementById(`comment-${commentData.id}`)) {
                return;
            }

    const commentHtml = `
            <div class="comment-item" data-comment-id="${commentData.id}" id="comment-${commentData.id}">
                <div class="flex gap-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-[#B59F84] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                            <span class="text-sm font-bold text-white">
                                ${commentData.user.fname ? (commentData.user.fname.charAt(0) + commentData.user.lname.charAt(0)).toUpperCase() : 'U'}
                            </span>
                        </div>
                    </div>
                   
                    <!-- Comment Content -->
                    <div class="flex-1">
    <div class="flex-1">
        <!-- Comment Header -->
        <div class="flex justify-between items-start mb-1">
            <div>
                <a href="/profile/${commentData.user.id}" class="font-semibold text-gray-800 dark:text-gray-200 hover:underline">
                    ${commentData.user.fname} ${commentData.user.lname}
                </a>
                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">
                    ${commentData.created_at ? getTimeAgo(new Date(commentData.created_at)) : 'just now'}
                </span>
            </div>
            
            <!-- Comment Options -->
            <div class="relative">
                <button type="button" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-600" onclick="toggleDropdown(${commentData.id})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </button>
                
                <!-- Dropdown -->
                <div id="dropdown-${commentData.id}" class="absolute right-0 mt-1 w-28 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow z-10 hidden">
                    <button type="button" onclick="toggleEditForm(${commentData.id})" class="w-full text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Edit
                    </button>
                    <button type="button" onclick="deleteComment(${commentData.id})" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- Comment Content -->
        <div id="comment-content-${commentData.id}" class="text-gray-800 dark:text-gray-200 mb-2">
            ${commentData.content}
        </div>

        <!-- Engagement Buttons -->
        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
            <!-- Like -->
            <button onclick="toggleLike(${commentData.id})" 
                    class="flex items-center gap-1 hover:text-[#B59F84] transition-colors duration-200 "
                    id="like-btn-${commentData.id}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span id="like-count-${commentData.id}">0</span>
            </button>

            <!-- Reply -->
            <button onclick="toggleReplyForm(${commentData.id})" 
                    class="flex items-center gap-1 hover:text-[#B59F84] transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                Reply
            </button>
        </div>
    </div>

    <!-- Inline Edit Form -->
    <form id="inline-edit-form-${commentData.id}" action="/comments/${commentData.id}" method="POST" class="inline-edit-form hidden mt-2 bg-gray-100 dark:bg-gray-600 p-3 rounded-lg" data-id="${commentData.id}">
        <textarea name="content" rows="2" class="w-full border rounded p-2 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200">${commentData.content}</textarea>
        <div class="flex gap-2 mt-2">
            <button type="submit" class="px-3 py-1 bg-[#B59F84] text-white rounded text-sm hover:bg-[#a08e77] transition-all duration-200">Save</button>
            <button type="button" onclick="cancelEdit(${commentData.id})" class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 text-sm">Cancel</button>
        </div>
    </form>

    <!-- Reply Form -->
    <div id="reply-form-${commentData.id}" class="hidden mt-3 ml-4">
        <form class="reply-form" data-parent-id="${commentData.id}">
            <div class="flex gap-2">
                <textarea name="content" placeholder="Write a reply..." class="flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:bg-gray-700 dark:text-white" rows="2" required></textarea>
                <div class="flex flex-col gap-2">
                    <button type="submit" class="px-3 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition-all duration-200 text-sm">Reply</button>
                    <button type="button" onclick="toggleReplyForm(${commentData.id})" class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 text-sm">Cancel</button>
                </div>
            </div>
            <input type="hidden" name="parent_id" value="${commentData.id}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </form>
    </div>

    <!-- Replies -->
    <div id="replies-${commentData.id}" class="hidden ml-4 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4">
        <!-- Replies will be appended here dynamically -->
    </div>
                    </div>
                </div>
            </div>

        `;

            commentsContainer.insertAdjacentHTML('afterbegin', commentHtml);

            // Scroll to the new comment
            const newComment = document.getElementById(`comment-${commentData.id}`);
            if (newComment) {
                newComment.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }


        // Toggle like functionality
        function toggleLike(commentId) {
            fetch(`/comments/${commentId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        reaction_type: 'like'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const likeBtn = document.getElementById(`like-btn-${commentId}`);
                        const likeCount = document.getElementById(`like-count-${commentId}`);

                        // Update button appearance
                        if (data.is_liked) {
                            likeBtn.classList.remove('text-gray-500');
                            likeBtn.classList.add('text-blue-500');
                            likeBtn.querySelector('svg').setAttribute('fill', 'currentColor');
                        } else {
                            likeBtn.classList.remove('text-blue-500');
                            likeBtn.classList.add('text-gray-500');
                            likeBtn.querySelector('svg').setAttribute('fill', 'none');
                        }

                        // Update count
                        likeCount.textContent = data.likes_count;
                    }
                })
                .catch(error => {
                    console.error('Error toggling like:', error);
                });
        }

        // Toggle reply form
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm) {
                replyForm.classList.toggle('hidden');
                if (!replyForm.classList.contains('hidden')) {
                    replyForm.querySelector('textarea').focus();
                }
            }
        }

        // Toggle replies display
        function toggleReplies(commentId) {
            const repliesContainer = document.getElementById(`replies-${commentId}`);
            if (repliesContainer) {
                repliesContainer.classList.toggle('hidden');
            }
        }

        // Handle reply form submission
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('submit', function(e) {
                if (e.target.classList.contains('reply-form')) {
                    e.preventDefault();

                    const formData = new FormData(e.target);
                    const parentId = e.target.dataset.parentId;
                    const submitButton = e.target.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;

                    // Show loading state
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    submitButton.disabled = true;

                    fetch("{{ route('comments.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(async (response) => {
                            const contentType = response.headers.get('content-type') || '';
                            if (!response.ok) {
                                if (contentType.includes('application/json')) {
                                    const errorData = await response.json();
                                    const msg = errorData.message || errorData.errors?.content?.[
                                        0] || 'Error';
                                    throw new Error(msg);
                                } else {
                                    throw new Error('Request failed (maybe login required).');
                                }
                            }
                            if (!contentType.includes('application/json')) {
                                throw new Error('Unexpected response from server.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Clear the textarea
                                e.target.querySelector('textarea').value = '';

                                // Hide the reply form
                                toggleReplyForm(parentId);

                                // Show the replies container if it's hidden
                                const repliesContainer = document.getElementById(`replies-${parentId}`);
                                if (repliesContainer && repliesContainer.classList.contains('hidden')) {
                                    repliesContainer.classList.remove('hidden');
                                }

                                // Add the new reply to the replies container
                                addReplyToDOM(data.comment, parentId);

                                // Update replies count
                                updateRepliesCount(parentId);
                            } else {
                                throw new Error(data.message || 'An error occurred');
                            }
                        })
                        .catch(error => {
                            alert(error.message || 'Failed to post reply. Please try again.');
                        })
                        .finally(() => {
                            submitButton.innerHTML = originalButtonText;
                            submitButton.disabled = false;
                        });
                }
            });
        });

        function addReplyToDOM(commentData) {
            // ✅ Ensure this is a reply
            if (!commentData.parent_id) {
                console.warn("Tried to add a reply without parent_id:", commentData);
                return;
            }

            // ✅ Get or create replies container for the parent (comment or reply)
            let repliesContainer = document.getElementById(`replies-${commentData.parent_id}`);
            if (!repliesContainer) {
                const parentEl = document.getElementById(`comment-${commentData.parent_id}`) || document.getElementById(
                    `reply-${commentData.parent_id}`);
                if (parentEl) {
                    repliesContainer = document.createElement('div');
                    repliesContainer.id = `replies-${commentData.parent_id}`;
                    repliesContainer.className = 'ml-8 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4';
                    parentEl.appendChild(repliesContainer);
                } else {
                    console.warn('Parent element not found for reply:', commentData.parent_id);
                    return;
                }
            }

            // ✅ Prevent duplicate reply rendering
            if (document.getElementById(`reply-${commentData.id}`)) {
                return;
            }

            // ✅ Build reply HTML with its own reply form and nested container
            const replyHtml = `
        <div class=\"reply-item flex gap-3\" id=\"reply-${commentData.id}\" data-comment-id=\"${commentData.id}\">
            <div class=\"flex-shrink-0\">
                <div class=\"w-8 h-8 bg-[#B59F84] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center\">
                    <span class=\"text-sm font-bold text-white\">
                        ${(commentData.user?.fname?.charAt(0).toUpperCase() ?? '')}${(commentData.user?.lname?.charAt(0).toUpperCase() ?? '')}
                    </span>
                </div>
            </div>
            <div class=\"flex-1\">
                <div>
                    <a href=\"/profile/${commentData.user?.id}\" class=\"text-sm font-semibold text-gray-800 dark:text-gray-200 hover:underline\">
                        ${commentData.user?.fname ?? ''} ${commentData.user?.lname ?? ''}
                    </a>
                    <span class=\"text-xs text-gray-500 dark:text-gray-400 ml-2\">just now</span>
                </div>
                <p class=\"text-sm text-gray-800 dark:text-gray-200\">${commentData.content}</p>

                <div class=\"mt-2 flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400\">
                    <button onclick=\"toggleReplyForm(${commentData.id})\" class=\"hover:text-[#B59F84] transition-colors duration-200\">Reply</button>
                </div>

                <div id=\"reply-form-${commentData.id}\" class=\"hidden mt-3 ml-4\">
                    <form class=\"reply-form\" data-parent-id=\"${commentData.id}\">
                    <div class="flex gap-2">
                        <textarea name=\"content\" placeholder="Write a reply..." class=\"flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:bg-gray-700 dark:text-white\" rows=\"2\" required></textarea>
                          <div class="flex flex-col gap-2">
                     
                        <button type=\"submit\" class=\"px-3 py-2 bg-[#B59F84] text-white rounded-lg hover:bg-[#a08e77] transition-all duration-200 text-sm\">Reply</button>
                        <button type=\"button\" onclick=\"toggleReplyForm(${commentData.id})\" class=\"px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 text-sm\">Cancel</button>
                           </div>
                     </div>
                  </form>
                </div>
               <input type=\"hidden\" name=\"parent_id\" value=\"${commentData.id}\">
               <input type=\"hidden\" name=\"product_id\" value=\"${commentData.product_id}\">
                <div id=\"replies-${commentData.id}\" class=\"hidden ml-8 mt-3 space-y-3 border-l-2 border-gray-200 dark:border-gray-600 pl-4\"></div>
            </div>
        </div>
    `;

            repliesContainer.insertAdjacentHTML('beforeend', replyHtml);
        }

        // Helper function to format time ago
        function getTimeAgo(date) {
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);

            if (diffInSeconds < 60) {
                return 'just now';
            } else if (diffInSeconds < 3600) {
                const minutes = Math.floor(diffInSeconds / 60);
                return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
            } else if (diffInSeconds < 86400) {
                const hours = Math.floor(diffInSeconds / 3600);
                return `${hours} hour${hours > 1 ? 's' : ''} ago`;
            } else if (diffInSeconds < 2592000) {
                const days = Math.floor(diffInSeconds / 86400);
                return `${days} day${days > 1 ? 's' : ''} ago`;
            } else {
                return date.toLocaleDateString();
            }
        }

        // Update replies count
        function updateRepliesCount(commentId) {
            const repliesContainer = document.getElementById(`replies-${commentId}`);
            if (repliesContainer) {
                const repliesCount = repliesContainer.querySelectorAll('.reply-item').length;
                const repliesButton = document.querySelector(`button[onclick="toggleReplies(${commentId})"]`);
                if (repliesButton) {
                    repliesButton.textContent = `${repliesCount} ${repliesCount === 1 ? 'reply' : 'replies'}`;
                }
            }
        }
    </script>
    <style>
        @keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 5px rgba(181, 159, 132, 0.3); }
    50% { box-shadow: 0 0 15px rgba(181, 159, 132, 0.6); }
}

.animate-pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Smooth transitions for modal */
.modal-enter {
    opacity: 0;
    transform: scale(0.95);
}

.modal-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 300ms, transform 300ms;
}

.modal-exit {
    opacity: 1;
}

.modal-exit-active {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 300ms, transform 300ms;
}
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .comment-item:hover .line-clamp-3 {
            -webkit-line-clamp: unset;
            display: block;
        }

        /* Dynamic width for comments */
        .comment-bubble {
            max-width: 40%;
            width: fit-content;
        }
    </style>

</x-app-layout>
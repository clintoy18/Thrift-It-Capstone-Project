<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $donation->name }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">

            <!-- Mobile: Actions at top -->
            <div class="flex gap-2 text-sm mb-4 md:hidden">
                <a href="{{ route('private.chat', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-[20px] py-2 rounded-[25px] text-base font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full text-center">Message</a>
                <a href="{{ route('profile.show', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-[20px] py-2 rounded-[25px] text-base font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full text-center">Profile</a>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Left Column: Image -->
                <div class="md:w-1/3">
                    <img 
                        src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                        alt="{{ $donation->name }}"
                        class="w-full h-64 sm:h-72 md:h-64 object-cover object-center rounded-lg"
                    >
                    <div >
                            <p class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ $donation->user->fname }} {{ $donation->user->lname }}
                            </p>
                   </div>
                    <div class=" mt-6 mb-[-20px]">
                        <p class="text-lg font-bold text-[#B59F84]">Free</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $donation->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($donation->status) }}</p>

                        @if(Auth::id() === $donation->user_id)
                            <a href="{{ route('donations.edit', $donation->id) }}" 
                               class="inline-block mt-3 px-4 py-2 bg-[#B59F84] text-white rounded-lg  hover:bg-[#a08e77] w-full sm:w-auto text-center">
                                Update donation
<<<<<<< HEAD
=======
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div class="md:w-2/3 flex flex-col gap-6">

                    <!-- User Info -->
                    <div class="flex items-center gap-4">
                       
                        <div class="ml-auto flex gap-2 text-sm w-full sm:w-auto hidden md:flex">
                            <a href="{{ route('private.chat', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                        px-[20px] py-2 rounded-[25px] text-base font-semibold 
                                        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full sm:w-[120px] text-center">
                                Message
                            </a>
                            <a href="{{ route('profile.show', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white 
                                        px-[20px] py-2 rounded-[25px] text-base font-semibold 
                                        hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full sm:w-[120px] text-center">
                                Profile
>>>>>>> 42c27a126a1ef83c8f8624e9040fde07613e5120
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div class="md:w-2/3 flex flex-col gap-8">

                    <!-- User Info -->
            
                     <div>    <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-32 bg-gradient-to-r from-blue-400 to-purple-500">                                        
                            <!-- You can replace this with an actual background image -->
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                        </div>
                        
                        <!-- User Info Section -->
                        <div class="relative bg-[#E1D5B6] p-4">
                            <!-- Avatar -->
                            
                            
                            <!-- User Details -->
                            <div class="flex items-start justify-between pt-4">
                                <div class="flex-1">
                                    
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
                                    <a href="{{ route('private.chat', $donation->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Message
                                    </a>
                                    
                                    <!-- Visit Profile Button -->
                                    <a href="{{ route('profile.show', $donation->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Visit Profile
                                    </a>
                                </div>
                            </div>
                            </div>
                    </div>

                    <!-- Donation Info -->
<<<<<<< HEAD
                    <div class="mt-6 mb-[-20px]">
                        <h1 class="text-xl sm:text-2xl font-bold mb-1 ">{{ $donation->name }}</h1>
=======
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ $donation->name }}</h1>
>>>>>>> 42c27a126a1ef83c8f8624e9040fde07613e5120
                        <p class="text-xs sm:text-sm text-gray-600">
                            Size: {{ $donation->size }} · 
                            {{ ucfirst($donation->condition) }} condition · 
                            {{ $donation->category->name ?? 'No Category' }}
                        </p>
                    </div>

                    <!-- Always show Free in red -->
                    

                    <!-- Comments -->
<<<<<<< HEAD
                    <h3 class="text-base sm:text-lg font-bold mt-9 mb-[-40px]">Comments</h3>
                    <div class="border p-3 sm:p-4 rounded-lg mt-9 mb-[-30px] bg-[#F4F2ED]">
=======
                    <h3 class="text-base sm:text-lg font-bold mt-6 mb-[-20px]">Comments</h3>
                    <div class="border p-3 sm:p-4 rounded-lg bg-[#F4F2ED]">
>>>>>>> 42c27a126a1ef83c8f8624e9040fde07613e5120
                        
                        <div class="max-h-80 overflow-y-auto space-y-3 sm:space-y-4">
                            @forelse($donation->comments as $comment)
                            <div class="inline-block max-w-full bg-[#E1D5B6] dark:bg-gray-700 p-3 rounded-lg shadow">
                                    <p class="font-semibold whitespace-nowrap">{{ $comment->user->fname }} {{ $comment->user->lname }}</p>
                                    <p class="mt-1 text-gray-800 dark:text-gray-200 break-words">{{ $comment->content }}</p>
                                </div>

                                <p class="text-gray-500 flex flex-col relative top-[-8px]  text-xs">{{ $comment->created_at->diffForHumans() }}</p>

                            @empty
                                <p class="text-gray-600 flex flex-col relative top-[20px] text-sm">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>

                        @auth
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="flex flex-col md:flex-row items-start gap-4 w-full max-w-lg bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-md">
                                    <input type="hidden" name="donation_id" value="{{ $donation->id }}">

                                    <textarea
                                        name="content"
                                        placeholder="Write a comment..."
                                        class="w-full resize-none overflow-hidden rounded-full px-4 py-2 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#E1D5B6] border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700"
                                        rows="1"
                                        oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px';"
                                        required></textarea>



                                        <button type="submit"
                                            class="mt-2 md:mt-0 md:self-center bg-[#E1D5B6] text-white font-semibold px-4 py-2.5 rounded-full shadow hover:shadow-md hover:bg-[#d1c29f] transition-all duration-300 ease-in-out flex items-center justify-center w-full md:w-auto">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>

                                </div>


                            </form>
                        @else
                            <p class="mt-3 text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to comment.
                            </p>
                        @endauth
                    </div>

                    <!-- Back Link -->
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('donations.index') }}" class="inline-flex items-center gap-2 text-[#B59F84] hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7M3 12h18" />
                            </svg>
                            <span>Back to donations</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {
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
</script>

</x-app-layout>

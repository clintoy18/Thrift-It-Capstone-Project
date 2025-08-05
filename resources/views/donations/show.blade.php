<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $donation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Left Column: Image -->
                <div class="md:w-1/3">
                    <img 
                        src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                        alt="{{ $donation->name }}"
                        class="w-full h-64 object-cover rounded-lg"
                    >
                </div>

                <!-- Right Column -->
                <div class="md:w-2/3 flex flex-col gap-6">

                    <!-- User Info -->
                    <div class="flex items-center gap-4">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ $donation->user->fname }} {{ $donation->user->lname }}
                            </p>
                        </div>
                        <div class="ml-auto flex gap-2 text-sm">
                            <a href="{{ route('private.chat', $donation->user->id) }}" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                                Message
                            </a>
                            <a href="{{ route('profile.show', $donation->user->id) }}" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
                                Profile
                            </a>
                        </div>
                    </div>

                    <!-- Donation Info -->
                    <div>
                        <h1 class="text-2xl font-bold mb-1">{{ $donation->name }}</h1>
                        <p class="text-sm text-gray-600">
                            Size: {{ $donation->size }} · 
                            {{ ucfirst($donation->condition) }} condition · 
                            {{ $donation->category->name ?? 'No Category' }}
                        </p>
                    </div>

                    <!-- Always show Free in red -->
                    <div>
                        <p class="text-lg font-bold text-red-600">Free</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $donation->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($donation->status) }}</p>

                        @if(Auth::id() === $donation->user_id)
                            <a href="{{ route('donations.edit', $donation->id) }}" 
                               class="inline-block mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Update donation
                            </a>
                        @endif
                    </div>

                    <!-- Comments -->
                    <div class="border p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                        <h3 class="text-lg font-bold mb-4">Comments</h3>
                        <div class="max-h-60 overflow-y-auto space-y-4">
                            @forelse($donation->comments as $comment)
                                <div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow">
                                    <p class="font-semibold">{{ $comment->user->fname }} {{ $comment->user->lname }}</p>
                                    <p class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
                                    <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-gray-600 text-sm">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>

                        @auth
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                                <textarea name="content" rows="3" maxlength="1000"
                                    class="w-full border rounded-lg p-2" required></textarea>
                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    Post Comment
                                </button>
                            </form>
                        @else
                            <p class="mt-3 text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to comment.
                            </p>
                        @endauth
                    </div>

                    <!-- Back Link -->
                    <a href="{{ route('donations.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">
                        Back to donations
                    </a>
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

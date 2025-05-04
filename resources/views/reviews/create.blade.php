<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Write a Review for ') . $user->lname }}   {{$user->fname }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form action="{{ route('reviews.store', $user) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
            @csrf

            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rating</label>
                <select id="rating" name="rating" required class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-gray-200">
                    <option value="">Select rating</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Comment -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Comment (optional)</label>
                <textarea id="comment" name="comment" rows="4" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-gray-200">{{ old('comment') }}</textarea>
                @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="text-right">
                <x-primary-button type="submit">Submit Review</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

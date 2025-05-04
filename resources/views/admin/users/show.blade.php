<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- User Basic Info -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Basic Information</h3>
                <div class="grid sm:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                    <p><span class="font-semibold">First Name:</span> {{ $user->fname }}</p>
                    <p><span class="font-semibold">Last Name:</span> {{ $user->lname }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                    <p><span class="font-semibold">Joined:</span> {{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>

            <!-- Activity Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Products -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Products</h3>
                    <div class="space-y-3">
                        @forelse($user->products as $product)
                            <div class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                                <span>{{ $product->name }}</span>
                                <span class="px-2 py-0.5 inline-flex text-xs font-semibold rounded-full 
                                    {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 
                                       ($product->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No products found</p>
                        @endforelse
                    </div>
                </div>

                <!-- Reports Received -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reports Received</h3>
                    <div class="space-y-3">
                        @forelse($user->reportsReceived as $report)
                            <div class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                                <span>Report from {{ $report->reporter->first_name }}</span>
                                <span class="px-2 py-0.5 inline-flex text-xs font-semibold rounded-full 
                                    {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($report->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No reports found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Update Form -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Update User Status</h3>
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account Status</label>
                            <select name="is_active" id="is_active"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Reviews Received -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Reviews Received</h3>

    @forelse($user->reviewsReceived as $review)
        <div class="mb-4 p-4 border dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700">
            <div class="flex justify-between items-center mb-1">
                <div class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    {{ $review->reviewer->fname ?? 'Anonymous' }}
                </div>
                <div class="flex space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.362 4.197a1 1 0 00.95.69h4.417c.969 0 1.371 1.24.588 1.81l-3.58 2.601a1 1 0 00-.364 1.118l1.362 4.197c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.58 2.601c-.784.57-1.838-.197-1.539-1.118l1.362-4.197a1 1 0 00-.364-1.118L2.3 9.624c-.782-.57-.38-1.81.588-1.81h4.418a1 1 0 00.949-.69l1.362-4.197z" />
                        </svg>
                    @endfor
                </div>
            </div>
                @if($review->comment)
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

        </div>
    </div>
</x-app-layout>

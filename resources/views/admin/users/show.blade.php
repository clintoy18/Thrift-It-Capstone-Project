<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- User Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Basic Information</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">First Name:</span> {{ $user->fname }}</p>
                                <p><span class="font-medium">Last Name:</span> {{ $user->lname }}</p>
                                <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                                <p><span class="font-medium">Joined:</span> {{ $user->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Account Status</h3>
                            <div class="space-y-2">
                                <p>
                                    <span class="font-medium">Role:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $user->role_name }}
                                    </span>
                                </p>
                                <p>
                                    <span class="font-medium">Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- User Activity -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Products</h3>
                            <div class="space-y-2">
                                @forelse($user->products as $product)
                                    <div class="flex justify-between items-center">
                                        <span>{{ $product->name }}</span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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

                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Reports Received</h3>
                            <div class="space-y-2">
                                @forelse($user->reportsReceived as $report)
                                    <div class="flex justify-between items-center">
                                        <span>Report from {{ $report->reporter->first_name }}</span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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
                    <div class="mt-6">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                    <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="is_active" class="flex items-center">
                                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                                            {{ $user->is_active ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Active Account</span>
                                    </label>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
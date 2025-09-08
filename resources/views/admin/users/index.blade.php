<!-- filepath: resources/views/admin/users/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <!-- ✅ Verified Users -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-green-600">Verified Users</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                            <tr>
                                <th class="px-6 py-3">Last Name</th>
                                <th class="px-6 py-3">First Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Joined</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4">{{ $user->lname }}</td>
                                    <td class="px-6 py-4">{{ $user->fname }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $user->role_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Verified
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 flex space-x-3">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 dark:bg-indigo-900 dark:text-indigo-200">
                                            View
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 dark:bg-red-900 dark:text-red-200">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400">No verified users.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $users->links() }}
                </div>
            </div>

            <!-- ⚠️ Pending Users -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-yellow-600">Pending Users</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                            <tr>
                                <th class="px-6 py-3">Last Name</th>
                                <th class="px-6 py-3">First Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Joined</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($pendingUsers as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4">{{ $user->lname }}</td>
                                    <td class="px-6 py-4">{{ $user->fname }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $user->role_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 flex space-x-3">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 dark:bg-indigo-900 dark:text-indigo-200">
                                            View
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 dark:bg-red-900 dark:text-red-200">
                                                 Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400">No pending verifications.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

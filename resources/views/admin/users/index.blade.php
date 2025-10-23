<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Pending Users --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-yellow-600 dark:text-yellow-300 mb-4">Pending Users</h3>
                    <div class="overflow-x-auto">
                        @include('admin.users._table', [
                            'users' => $pendingUsers, 
                            'showDocument' => true, 
                            'statusColors' => [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'verified' => 'bg-green-100 text-green-800',
                                'unverified' => 'bg-red-100 text-red-800'
                            ]
                        ])
                        <div class="mt-4">{{ $pendingUsers->links() }}</div>
                    </div>
                </div>
            </div>

            {{-- Verified Users --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-green-600 dark:text-green-300 mb-4">Verified Users</h3>
                    <div class="overflow-x-auto">
                        @include('admin.users._table', [
                            'users' => $users, 
                            'showDocument' => false,
                            'statusColors' => [
                                'verified' => 'bg-green-100 text-green-800'
                            ]
                        ])
                        <div class="mt-4">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>

            {{-- Unverified Users --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-300 mb-4">Unverified Users</h3>
                    <div class="overflow-x-auto">
                        @include('admin.users._table', [
                            'users' => $unverifiedUsers, 
                            'showDocument' => false,
                            'statusColors' => [
                                'unverified' => 'bg-red-100 text-red-800'
                            ]
                        ])
                    </div>
                </div>
            </div>

            {{-- Rejected Users --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-red-600 dark:text-red-300 mb-4">Rejected Users</h3>
                    <div class="overflow-x-auto">
                        @include('admin.users._table', [
                            'users' => $rejectedUsers, 
                            'showDocument' => false,
                            'statusColors' => [
                                'unverified' => 'bg-red-100 text-red-800'
                            ]
                        ])
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

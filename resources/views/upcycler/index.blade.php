<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upcycler Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 text-gray-900 dark:text-gray-100">
                    {{ __("Appointments") }}
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-gray-700 dark:text-gray-200 border">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">User</th>
                                <th class="px-4 py-2 border">Type</th>
                                <th class="px-4 py-2 border">Date</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr class="bg-white dark:bg-gray-800">
                                    <td class="px-4 py-2 border">
                                        {{ $appointment->user->lname }}, {{ $appointment->user->fname }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ $appointment->apptype }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($appointment->appdate)->format('F j, Y g:i A') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <span class="capitalize">{{ $appointment->appstatus }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center px-4 py-2">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

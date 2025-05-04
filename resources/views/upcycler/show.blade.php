<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appointment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="text-gray-900 dark:text-gray-100 mb-6">
                    <h3 class="text-lg font-semibold mb-4">Appointment Information</h3>

                    <p><strong>User:</strong> {{ $appointment->user->lname }}, {{ $appointment->user->fname }}</p>
                    <p><strong>Email:</strong> {{ $appointment->user->email }}</p>
                    <p><strong>Type:</strong> {{ $appointment->apptype }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appdate)->format('F j, Y g:i A') }}</p>
                    <p><strong>Status:</strong> <span class="capitalize">{{ $appointment->appstatus }}</span></p>
                    <p><strong>Created at:</strong> {{ $appointment->created_at->format('F j, Y g:i A') }}</p>
                </div>

                <!-- Status Update Form -->
                <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-2">Update Status</h4>
                    <form method="POST" action="{{ route('upcycler.update', $appointment) }}">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center space-x-4">
                            <select name="appstatus" class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm">
                                <option value="pending" {{ $appointment->appstatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $appointment->appstatus === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="declined" {{ $appointment->appstatus === 'declined' ? 'selected' : '' }}>Declined</option>
                                <option value="completed" {{ $appointment->appstatus === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Navigation and Delete -->
                <div class="flex space-x-4 mt-8">
                    <a href="{{ route('upcycler.index') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">
                        Back to Appointments
                    </a>

                    <form action="{{ route('upcycler.destroy', $appointment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-4 py-2 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

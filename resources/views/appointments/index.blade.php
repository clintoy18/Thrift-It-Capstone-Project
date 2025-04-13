<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Available Upcyclers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcyclers as $upcycler)
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ $upcycler->fname }} {{ $upcycler->lname }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $upcycler->email }}</p>
                            <p class="text-gray-600 dark:text-gray-400 mt-2">
                                Specialization: {{ $upcycler->specialization ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('appointments.create', ['upcycler_id' => $upcycler->id]) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Request Appointment
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
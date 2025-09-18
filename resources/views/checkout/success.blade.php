<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Success') }}
        </h2>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <h1 class="text-3xl font-bold text-green-600 mb-4">Payment Successful!</h1>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">Thank you for your purchase. Your transaction has been completed successfully.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>



    
</x-app-layout>

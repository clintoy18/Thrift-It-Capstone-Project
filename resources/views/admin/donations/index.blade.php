<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donations Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    {{-- Pending donations Section --}}
                    <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300 mb-4">Pending donations</h3>
                    <div class="overflow-x-auto">
                        @include('admin.donations._table', ['donations' => $pendingDonations])
                        <div class="mt-4">
                            {{ $pendingDonations->links() }}
                        </div>
                    </div>

                    {{-- Approved donations Section --}}
                    <h3 class="text-lg font-semibold text-green-700 dark:text-green-300 mb-4">Approved Donations</h3>
                    <div class="overflow-x-auto mb-6">
                        @include('admin.donations._table', ['donations' => $approvedDonations])
                        <div class="mt-4">
                            {{ $approvedDonations->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    {{-- Pending Products Section --}}
                    <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300 mb-4">Pending Products</h3>
                    <div class="overflow-x-auto">
                        @include('admin.products._table', ['products' => $pendingProducts])
                        <div class="mt-4">
                            {{ $pendingProducts->links() }}
                        </div>
                    </div>

                    {{-- Approved Products Section --}}
                    <h3 class="text-lg font-semibold text-green-700 dark:text-green-300 mb-4">Approved Products</h3>
                    <div class="overflow-x-auto mb-6">
                        @include('admin.products._table', ['products' => $approvedProducts])
                        <div class="mt-4">
                            {{ $approvedProducts->links() }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

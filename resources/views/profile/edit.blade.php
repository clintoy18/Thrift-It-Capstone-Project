<x-app-layout>
 <x-slot name="header">
    <div class="flex items-center justify-between w-full">
        <!-- Left: Profile -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>

        <!-- Right: Upgrade Button -->
        <a href="{{ route('pricing.index') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-full shadow-md transition">
            Upgrade Your Plan
        </a>
    </div>
</x-slot>


    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Subscription Type --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Subscription Type') }}
                    </h3>

                    @if ($user->subscribedToProduct('prod_T4nVT7WiXSJe56'))
                        <p>You are subscribed to our Starter Rack plan.</p>
                    @endif

                    @if ($user->subscribedToPrice('price_basic_monthly'))
                        <p>You are subscribed to our monthly Basic plan.</p>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.upload-document')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.dashboard')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('appointments.update', $appointment) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Scheduled With (Read-only) -->
                    <div class="mb-4">
                        <x-input-label for="upcycler" :value="__('Scheduled with Upcycler')" />
                        <x-text-input
                            id="upcycler"
                            type="text"
                            class="mt-1 block w-full"
                            :value="$appointment->upcycler->fname . ' ' . $appointment->upcycler->lname"
                            disabled
                        />
                    </div>

                    <!-- Appointment Time (Read-only) -->
                    <div class="mb-4">
                        <x-input-label for="time" :value="__('Appointment Time')" />
                        <x-text-input
                            id="time"
                            type="text"
                            class="mt-1 block w-full"
                            :value="$appointment->created_at->format('M d, Y h:i A')"
                            disabled
                        />
                    </div>

                    <!-- Editable Appointment Details -->
                    <div class="mb-4">
                        <x-input-label for="appdetails" :value="__('Appointment Details')" />
                        <x-text-input
                            id="appdetails"
                            name="appdetails"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('appdetails', $appointment->appdetails)"
                            required
                        />
                        @error('appdetails')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Editable Contact Number -->
                    <div class="mb-4">
                        <x-input-label for="contactnumber" :value="__('Contact Number')" />
                        <x-text-input
                            id="contactnumber"
                            name="contactnumber"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('contactnumber', $appointment->contactnumber)"
                            required
                        />
                        @error('contactnumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit and Cancel -->
                    <div class="mt-6 flex items-center">
                        <x-primary-button>{{ __('Update Appointment') }}</x-primary-button>
                        <a href="{{ route('appointments.index') }}" class="ml-4 text-gray-600 hover:underline">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

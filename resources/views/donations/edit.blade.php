<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Donation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('donations.update', $donation) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Donation Name -->
                    <div>
                        <x-input-label for="name" :value="__('Donation Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                            :value="old('name', $donation->name)" required autofocus />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="block w-full mt-1 p-2 border rounded">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $donation->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                            <option value="available"
                                @if($donation->status === 'donated') disabled @endif
                                {{ old('status', $donation->status) === 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="donated" {{ old('status', $donation->status) === 'donated' ? 'selected' : '' }}>
                                Donated
                            </option>
                        </select>
                        @if($donation->status === 'donated')
                            <p class="text-sm text-red-600 mt-1">This donation has already been marked as donated and cannot be marked as available again.</p>
                        @endif
                    </div>

                    <!-- Image Upload -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Donation Image')" />
                        <input type="file" name="image" id="image" class="block w-full mt-1 p-2 border rounded">
                        @if ($donation->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $donation->image) }}" alt="Donation Image" class="w-32 h-32 object-cover">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Update Donation') }}</x-primary-button>
                        <a href="{{ route('donations.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

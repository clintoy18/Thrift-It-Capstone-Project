<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Request an Appointment') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <!-- Select Upcycler -->
                    <div class="mb-4">
                        <label for="upcycler_id" class="block text-black font-medium mb-2">Select Upcycler</label>
                        <select id="upcycler_id" name="upcycler_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                            <option value="" disabled selected>Select an upcycler</option>
                            @foreach ($upcyclers as $upcycler)
                                <option value="{{ $upcycler->id }}" {{ old('upcycler_id') == $upcycler->id ? 'selected' : '' }}>
                                    {{ $upcycler->fname }} {{ $upcycler->lname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Appointment Type -->
                    <div class="mb-4">
                        <label for="apptype" class="block text-black font-medium mb-2">Appointment Type</label>
                        <input type="text" id="apptype" name="apptype" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" placeholder="Enter appointment type" value="{{ old('apptype') }}" required>
                    </div>

                    <!-- Appointment Details -->
                    <div class="mb-4">
                        <label for="appdetails" class="block text-black font-medium mb-2">Details</label>
                        <textarea id="appdetails" name="appdetails" class="w-full px-4 py-2 border rounded-lg placeholder-gray-500 focus:ring-2 focus:ring-gray-500" placeholder="Enter details">{{ old('appdetails') }}</textarea>
                    </div>

                    <!-- Appointment Date -->
                    <div class="mb-4">
                        <label for="appdate" class="block text-black font-medium mb-2">Appointment Date</label>
                        <input type="datetime-local" id="appdate" name="appdate" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" value="{{ old('appdate') }}" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-black text-white font-medium py-2 px-4 rounded-lg hover:bg-gray-700 transition">Request Appointment</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
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

                    <!-- Display Upcycler Name -->
                    @if ($upcycler)
                        <div class="mb-4">
                            <label class="block text-black font-medium mb-2">Upcycler</label>
                            <p class="text-gray-800 dark:text-gray-200">{{ $upcycler->fname }} {{ $upcycler->lname }}</p>
                            <input type="hidden" name="upcycler_id" value="{{ $upcycler->id }}">
                        </div>
                    @endif

                    <!-- Appointment Type (ENUM Dropdown) -->
                    <div class="mb-4">
                        <label for="apptype" class="block text-black font-medium mb-2">Appointment Type</label>
                        <select id="apptype" name="apptype" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500" required>
                            <option value="">-- Select Appointment Type --</option>
                            @foreach (['Resize', 'Customize', 'Patchwork', 'Fabric Dyeing'] as $type)
                                <option value="{{ $type }}" {{ old('apptype') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Appointment Details -->
                    <div class="mb-4">
                        <label for="appdetails" class="block text-black font-medium mb-2">Details</label>
                        <textarea id="appdetails" name="appdetails" class="w-full px-4 py-2 border rounded-lg placeholder-gray-500 focus:ring-2 focus:ring-gray-500" placeholder="Enter details">{{ old('appdetails') }}</textarea>
                    </div>
                     <!-- Contact Number -->
                     <div class="mb-4">
                        <label for="contactnumber" class="block text-black font-medium mb-2">Contact number</label>
                        <textarea id="contactnumber" name="contactnumber" class="w-full px-4 py-2 border rounded-lg placeholder-gray-500 focus:ring-2 focus:ring-gray-500" placeholder="Enter contact number">{{ old('contactnumber') }}</textarea>
                    </div>

                    <!-- Appointment Date -->
                    <div class="mb-4">
                        <label for="appdate" class="block text-black font-medium mb-2">Appointment Date</label>
                        <input type="datetime-local" id="appdate" name="appdate"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gray-500"
                        value="{{ old('appdate') }}"
                        min="2025-05-02T08:00"
                        required>              
                      </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-black text-white font-medium py-2 px-4 rounded-lg hover:bg-gray-700 transition">Request Appointment</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('appdate');
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        const localDatetime = now.toISOString().slice(0, 16);
        input.min = localDatetime;

        input.addEventListener('change', () => {
            const selected = new Date(input.value);
            const hours = selected.getHours();

            if (hours < 8 || hours >= 18) {
                alert("Please select a time between 8:00 AM and 6:00 PM.");
                input.value = '';
            }
        });
    });
</script>


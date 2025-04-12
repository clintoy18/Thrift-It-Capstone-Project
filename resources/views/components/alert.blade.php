@if ($message)
    <div id="alert-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full relative">
            <!-- Centered Icon -->
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                @if ($type === 'success')
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @else
                    <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Title and Message -->
            <div class="mt-10 text-center">
                <div class="text-{{ $type === 'success' ? 'green' : 'red' }}-700 text-lg font-semibold">
                    {{ $type === 'success' ? 'Success' : 'Error' }}
                </div>
                <div class="mt-4 text-gray-700">
                    {{ $message }}
                </div>
            </div>

            <!-- Close Button -->
            <div class="mt-6 text-center">
                <button id="close-alert" class="bg-{{ $type === 'success' ? 'green' : 'red' }}-500 text-white px-4 py-2 rounded hover:bg-{{ $type === 'success' ? 'green' : 'red' }}-600">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Automatically hide the modal after 2 seconds
        setTimeout(() => {
            const modal = document.getElementById('alert-modal');
            if (modal) {
                modal.style.transition = 'opacity 0.5s ease';
                modal.style.opacity = '0';
                setTimeout(() => modal.remove(), 500); // Remove the modal after fading out
            }
        }, 2000);

        // Close the modal when the close button is clicked
        document.getElementById('close-alert').addEventListener('click', () => {
            const modal = document.getElementById('alert-modal');
            if (modal) {
                modal.style.transition = 'opacity 0.5s ease';
                modal.style.opacity = '0';
                setTimeout(() => modal.remove(), 500); // Remove the modal after fading out
            }
        });
    </script>
@endif
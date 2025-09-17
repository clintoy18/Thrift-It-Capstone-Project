@if (session('success'))
    @if(str_contains(session('success'), 'Comment'))
        <!-- Simple toast notification for comments -->
        <div id="toast-notification" class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2" aria-live="assertive">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @else
        <!-- Modal for other success messages -->
        <div id="alert-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" aria-live="assertive">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full relative">
                <!-- Success Icon -->
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <!-- Title and Message -->
                <div class="mt-10 text-center">
                    <div class="text-green-700 text-lg font-semibold">Success</div>
                    <div class="mt-4 text-gray-700">{{ session('success') }}</div>
                </div>

                <!-- Close Button -->
                <div class="mt-6 text-center">
                    <button id="close-alert" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
@endif

@if ($errors->any())
    <div id="alert-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" aria-live="assertive">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full relative">
            <!-- Error Icon -->
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <!-- Title and Message -->
            <div class="mt-10 text-center">
                <div class="text-red-700 text-lg font-semibold">Error</div>
                <div class="mt-4 text-gray-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>

            <!-- Close Button -->
            <div class="mt-6 text-center">
                <button id="close-alert" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

<script>
    // Handle toast notification (for comments)
    const toast = document.getElementById('toast-notification');
    if (toast) {
        // Auto-hide toast after 3 seconds
        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // Handle modal (for other success messages)
    const modal = document.getElementById('alert-modal');
    if (modal) {
        // Auto-hide modal after 5 seconds
        setTimeout(() => {
            modal.style.transition = 'opacity 0.5s ease';
            modal.style.opacity = '0';
            setTimeout(() => modal.remove(), 500);
        }, 5000);

        // Close the modal when the close button is clicked
        const closeButton = document.getElementById('close-alert');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                modal.style.transition = 'opacity 0.5s ease';
                modal.style.opacity = '0';
                setTimeout(() => modal.remove(), 500);
            });
        }
    }
</script>

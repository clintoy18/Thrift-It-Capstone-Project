@if (session('success'))
    <div id="alert-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" aria-live="assertive">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full relative">
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div class="mt-10 text-center">
                <div class="text-green-700 text-lg font-semibold">Success</div>
                <div class="mt-4 text-gray-700">{!! session('success') !!}</div> <!-- UPDATED: Allow HTML -->
            </div>
            <div class="mt-6 text-center">
                <button id="close-alert" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="alert-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" aria-live="assertive">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full relative">
            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
                <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="mt-10 text-center">
                <div class="text-red-700 text-lg font-semibold">Error</div>
               <div class="mt-4 text-gray-700">
                    {!! session('error') !!}
                    <p class="text-sm text-gray-500 mt-2">
                        Want more features? <a href="/upgrade" class="text-blue-500 underline">Explore our Pro Plan</a>.
                    </p>
                </div>
            </div>
            <div class="mt-6 text-center">
                <button id="close-alert" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

<script>
    setTimeout(() => {
        const modal = document.getElementById('alert-modal');
        if (modal) {
            modal.style.transition = 'opacity 0.5s ease';
            modal.style.opacity = '0';
            setTimeout(() => modal.remove(), 500);
        }
    }, 5000);

    document.addEventListener('click', function(e) {
        if (e.target.id === 'close-alert') {
            const modal = document.getElementById('alert-modal');
            if (modal) {
                modal.style.transition = 'opacity 0.5s ease';
                modal.style.opacity = '0';
                setTimeout(() => modal.remove(), 500);
            }
        }
    });
</script>

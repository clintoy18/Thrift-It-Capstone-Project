{{-- Success Banner --}}
@if (session('success'))
    <div id="alert-banner-success"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50
               max-w-lg w-full px-6 py-3 rounded-lg shadow-md flex items-center justify-between relative
               bg-white border-l-4 border-green-500 text-green-700 animate-slide-down"
        aria-live="assertive">

        <!-- Icon + Message -->
        <div class="flex items-center gap-2">
            <!-- Outlined Circle Check -->
            <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>

        <!-- Distinct Close Button -->
        <button class="p-1 rounded-full border border-gray-400 text-gray-600 hover:bg-gray-100 hover:border-gray-600 absolute top-2 right-2 transition"
            onclick="closeBanner(this)">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

{{-- Error Banner --}}
@if (session('error'))
    <div id="alert-banner-error"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50
               max-w-lg w-full px-6 py-3 rounded-lg shadow-md flex items-center justify-between relative
               bg-white border-l-4 border-red-500 text-red-700 animate-slide-down"
        aria-live="assertive">

        <!-- Icon + Message -->
        <div class="flex items-center gap-2">
            <!-- Outlined Circle X -->
            <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l6 6M15 9l-6 6" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>

        <!-- Distinct Close Button -->
        <button class="p-1 rounded-full border border-gray-400 text-gray-600 hover:bg-gray-100 hover:border-gray-600 absolute top-2 right-2 transition"
            onclick="closeBanner(this)">
            <svg class="w-2 h-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

{{-- Styles --}}
<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translate(-50%, -20px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }
    .animate-slide-down {
        animation: slideDown 0.4s ease-out;
    }
</style>

{{-- Script --}}
<script>
    function closeBanner(button) {
        const banner = button.closest("div[id^='alert-banner']");
        if (banner) {
            banner.style.transition = "opacity 0.5s ease, transform 0.5s ease";
            banner.style.opacity = "0";
            banner.style.transform = "translate(-50%, -20px)";
            setTimeout(() => banner.remove(), 500);
        }
    }

    // Auto-hide after 5 seconds
    document.querySelectorAll("div[id^='alert-banner']").forEach(banner => {
        setTimeout(() => {
            const btn = banner.querySelector("button");
            if (btn) closeBanner(btn);
        }, 5000);
    });
</script>

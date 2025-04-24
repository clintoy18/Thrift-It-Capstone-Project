<div class="py-12 text-center bg-white dark:bg-gray-800 rounded-xl shadow-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 
              0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>

    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ $message ?? 'No items found' }}
    </h3>

    @if (isset($link))
        <p class="mt-2 text-gray-500 dark:text-gray-400">Why not get started?</p>
        <div class="mt-6">
            <a href="{{ $link }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                List your first product
            </a>
        </div>
    @endif
</div>

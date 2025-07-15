<div class="py-12 text-center bg-white rounded-xl shadow-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-black-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 
              0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>

    <h3 class="mt-4 text-lg font-medium text-[#56432C]">
        {{ $message ?? 'No items found' }}
    </h3>

    @if (isset($link))
        <p class="mt-2 text-[#56432C]">Why not get started?</p>
        <div class="mt-6">
            <a href="{{ $link }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#B59F84] transition-all duration-200 hover:bg-[#a08e77] hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                List your first product
            </a>
        </div>
    @endif
</div>

<div class="flex flex-col p-4">
    <div class="inline-flex rounded-full bg-gray-100 dark:bg-gray-800 p-1 mb-6">
        <button id="tab-products" type="button"
                class="px-5 py-2 rounded-full bg-[#E1D5B6] text-gray-800 font-semibold shadow-md transition-all">
            Products
        </button>
        <button id="tab-reviews" type="button"
                class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100 transition-all hover:bg-gray-200 dark:hover:bg-gray-700">
            Reviews
        </button>
        @if (Auth::id() === $user->id)
            <button id="tab-orders" type="button"
                    class="ml-2 px-5 py-2 rounded-full text-gray-800 dark:text-gray-100 transition-all hover:bg-gray-200 dark:hover:bg-gray-700">
                Orders
            </button>
        @endif
    </div>
</div>
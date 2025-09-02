<h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Dashboard</h2>

<div class="flex flex-wrap justify-between gap-4 mt-6">
    <!-- Total Listings -->
    <div class="flex-1 min-w-[120px] p-4 bg-white rounded-2xl border border-gray-300">
        <h2 class="text-sm font-medium text-gray-500">Total Listings</h2>
        <p class="mt-1 text-2xl sm:text-3xl font-semibold text-gray-900">{{ $totalListings }}</p>
    </div>

    <!-- Items Sold -->
    <div class="flex-1 min-w-[120px] p-4 bg-white rounded-2xl border border-gray-300">
        <h2 class="text-sm font-medium text-gray-500">Items Sold</h2>
        <p class="mt-1 text-2xl sm:text-3xl font-semibold text-gray-900">{{ $itemsSold }}</p>
    </div>
    <!-- Items Sold -->
    <div class="flex-1 min-w-[120px] p-4 bg-white rounded-2xl border border-gray-300">
        <h2 class="text-sm font-medium text-gray-500">Items Donated</h2>
        <p class="mt-1 text-2xl sm:text-3xl font-semibold text-gray-900">{{ $itemsDonated }}</p>
    </div>

    <!-- Revenue -->
    <div class="flex-1 min-w-[140px] p-4 bg-white rounded-2xl border border-gray-300">
        <h2 class="text-sm font-medium text-gray-500">Revenue</h2>
        <p class="mt-1 text-2xl sm:text-3xl font-semibold text-gray-900">₱{{ number_format($revenue, 2) }}</p>
    </div>






{{-- 
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold">Unread Messages</h2>
        <p class="text-3xl">{{ $unreadMessages }}</p>
    </div> --}}
</div>


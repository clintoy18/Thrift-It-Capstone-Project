<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
    {{-- <div class="p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold">Total Listings</h2>
        <p class="text-3xl">{{ $totalListings }}</p>
    </div> --}}

    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold">Items Sold</h2>
        <p class="text-3xl">{{ $itemsSold }}</p>
    </div>

    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold">Revenue</h2>
        <p class="text-3xl">₱{{ number_format($revenue, 2) }}</p>
    </div>
{{-- 
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold">Unread Messages</h2>
        <p class="text-3xl">{{ $unreadMessages }}</p>
    </div> --}}
</div>

<div>Dashboard

</div>
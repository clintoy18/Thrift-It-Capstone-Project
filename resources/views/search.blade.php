<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Search Products</h2>

        <form action="{{ route('search') }}" method="GET" class="mb-4">
            <input type="text" name="query" value="{{ request('query') }}" 
                   placeholder="Search for a product..."
                   class="w-full px-4 py-2 border rounded-md">
            <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-700">
                Search
            </button>
        </form>

        @if(request('query')) 
            @if($products->count())
                <h3 class="text-lg font-semibold mb-2">Search Results ({{ $products->count() }})</h3>
                <ul>
                    @foreach($products as $product)
                        <li class="p-4 border-b">
                            <strong>{{ $product->name }}</strong> - ₱{{ number_format($product->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No products found matching "<strong>{{ request('query') }}</strong>".</p>
            @endif
        @endif
    </div>

</body>
</html>

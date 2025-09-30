<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // store proof image
        $path = $request->file('proof')->store('proofs', 'public');

        // create order
        Order::create([
            'product_id' => $product->id,
            'buyer_id'   => Auth::id(),
            'proof'      => $path,
        ]);

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Proof of payment uploaded successfully. Please wait for seller confirmation.');
    }
}


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


    public function updateStatus(Order $order, string $status)
    {
        $allowedStatuses = ['pending', 'approved', 'delivering', 'completed', 'cancelled'];

        if (!in_array($status, $allowedStatuses)) {
            return back()->with('error', 'Invalid status.');
        }

        // Update product status if order is approved
        if ($status === 'approved' && $order->product) {
            $order->product->update(['status' => 'sold']);
        }

          // Update product status if order is approved
        if ($status === 'cancelled' && $order->product) {
            $order->product->update(['status' => 'available']);
        }

        $order->update(['status' => $status]);

        return back()->with('success', 'Order status updated to ' . ucfirst($status));
    }




}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalStatusProductUpdateRequest;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $product->load(['user', 'category', 'comments.user']);
        return view('admin.products.show', compact('product'));
    }
    

    public function update(ApprovalStatusProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product approval status updated successfully.');
    }
    
    public function edit(Product $product): View
    {
        $product->load(['user', 'category']);
        return view('admin.products.edit', compact('product'));
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
} 
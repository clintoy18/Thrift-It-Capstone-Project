<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalStatusProductUpdateRequest;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ProductService;

class AdminProductController extends Controller
{

    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(): View
    {
        $approvedProducts = $this->productService->getProductsByStatusPaginated('approved');
        $pendingProducts = $this->productService->getProductsByStatusPaginated('pending');

        return view('admin.products.index', compact('approvedProducts', 'pendingProducts'));
    }

    public function show(Product $product): View
    {
        $product->load(['user', 'category', 'comments.user','images']);
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

    public function approve(Product $product): RedirectResponse
    {
        $this->productService->updateProduct($product, ['approval_status' => 'approved']);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product approved successfully.');
    }

    public function reject(Product $product): RedirectResponse
    {
        $this->productService->updateProduct($product, ['approval_status' => 'rejected']);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product rejected successfully.');
    }


    
} 
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;



class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): View
    {
        $products = $this->productService->getProductsByUser(Auth::id());
        return view('products.index', compact('products'));
    }
    public function create(): View
    {
        $categories = Categories::all(); 
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
         $validated = $request->validated();
         $validated['user_id'] = Auth::id();
         $this->productService->createProduct($validated,$request->file('image')?? null);
           
         return redirect()->route('products.index')->with('success', 'Product created successfully!');
        }

    public function edit(Product $product): View
    {
        $categories = Categories::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $this->productService->updateProduct($product, $data, $request->file('image') ?? null);
       
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    
      //show product details
     public function show($id)
    {
            
        $product = $this->productService->getProductWithRelations($id);
        return view('products.show', compact('product'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index');
    }
}
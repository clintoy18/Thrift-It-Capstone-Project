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


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', compact('products'));
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Categories::all(); 
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
 
        public function store(StoreProductRequest $request): RedirectResponse
        {
            //check user subs plan and product count
            $user = Auth::user();
            if($user->subscription_plan == 'free' && Product::where('user_id', $user->id)->count() >= 5) {

                return redirect()->back()->with('error', 'You have reached the maximum number of products allowed for your subscription plan.');
            }

            $validated = $request->validated();

            $validated['user_id'] = Auth::id(); 
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('products_images', 'public');
            }

            Product::create($validated);

            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Categories::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
      
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath; // Add the image path to the validated data
        }

        // Update the product
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    
    //show product details
        public function show($id)
        {
            
            $product = Product::with(['user', 'category','comments'])->findOrFail($id);
            return view('products.show', compact('product'));
        }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
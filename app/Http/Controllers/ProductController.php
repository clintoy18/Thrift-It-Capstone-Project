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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Services\ProductService;
use App\Services\CategoriesService;
use App\Models\Segment;
use App\Models\Barangay;



class ProductController extends Controller
{

    protected $productService, $categoryService;


    public function __construct(ProductService $productService, CategoriesService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->middleware('subscribed')->only(['create', 'store']);
    }

    public function index(): View
    {
        $products = $this->productService->getProductsByUser(Auth::id());
        //fetch images
        //     $products->each(function ($product) {
        //     $product->first_image = $product->images->first()?->image ?? 'images/default-placeholder.png';
        // });
        return view('products.index', compact('products'));
    }
    public function create(): View
    {
        $categories = $this->categoryService->getAllCategories();
        $segments = Segment::all();
        $barangays = Barangay::all();
        return view('products.create', compact('categories', 'segments', 'barangays'));
    }

     public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        // Handle QR upload if provided
        if ($request->hasFile('qr_code')) {
            $validated['qr_code'] = $request->file('qr_code')->store('qr_codes', 'public');
        }

        // Handle multiple images
        $images = $request->file('images', []); // defaults to empty array if none

        // Create product with service
        $this->productService->createProduct($validated, $images);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product): View
    {
        $categories = $this->categoryService->getAllCategories();
        $segments = Segment::all();
        $barangays = Barangay::all();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'segments' => $segments,
            'barangays' => $barangays,
        ]);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        // ✅ Handle QR upload
        if ($request->hasFile('qr_code')) {
            if ($product->qr_code && Storage::exists($product->qr_code)) {
                Storage::delete($product->qr_code);
            }
            $product->qr_code = $request->file('qr_code')->store('qrcodes', 'public');
        }

        // ✅ Update other fields
        $product->fill($request->only([
            'category_id',
            'segment_id',
            'barangay_id',
            'name',
            'price',
            'status',
        ]));

        $product->save();

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product updated successfully!');
    }


    public function show($id)
    {
        // Clear cache for this product
        Cache::forget("product_{$id}_comments");
        Cache::forget("product_{$id}_with_comments");

        // Load product with relations
        $product = Product::with(['user', 'category'])->findOrFail($id);

        // ✅ Fetch only parent comments with their replies + users
        $comments = \App\Models\Comment::with(['user', 'replies.user'])
            ->where('product_id', $id)
            ->whereNull('parent_id')   // 👈 only top-level comments
            ->latest()
            ->get();

        // Attach comments to product
        $product->setRelation('comments', $comments);

        // "More from this seller"
        $moreProducts = $this->productService->getMoreProductsByUser(
            $product->user_id,
            $product->id
        );

        // Disable browser cache
        return response()
            ->view('products.show', compact('product', 'moreProducts'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->header('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT')
            ->header('ETag', md5(serialize($product->comments)));
    }


    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index');
    }


    public function markAsSold(Product $product): RedirectResponse
    {
        $this->productService->updateProduct($product, ['status' => 'sold']);

        return redirect()->route('products.index')
            ->with('success', 'Item marked as sold.');
    }
}

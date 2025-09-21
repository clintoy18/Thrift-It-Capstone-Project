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

    protected $productService,$categoryService;
    

    public function __construct(ProductService $productService, CategoriesService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->middleware('subscribed')->only(['create', 'store']);

    }

    public function index(): View
    {
        $products = $this->productService->getProductsByUser(Auth::id());
        return view('products.index', compact('products'));
    }
    public function create(): View
    {
        $categories = $this->categoryService->getAllCategories(); 
        $segments = Segment::all(); 
        $barangays = Barangay::all(); 
        return view('products.create', compact('categories', 'segments', 'barangays'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
         $validated = $request->validated();
         $validated['user_id'] = Auth::id();
         // Accept first image from images[] to maintain existing service signature
         $firstImage = null;
         if ($request->hasFile('images')) {
             $files = $request->file('images');
             if (is_array($files) && count($files) > 0) {
                 $firstImage = $files[0];
             }
         }
         $this->productService->createProduct($validated, $firstImage);
         return redirect()->route('products.index')->with('success', 'Product created successfully!');
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
        $data = $request->validated();
        $this->productService->updateProduct($product, $data, $request->file('image') ?? null);
       
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    
      //show product details
     public function show($id)
    {
        // Clear all cache related to this product and comments
        Cache::forget("product_{$id}_comments");
        Cache::forget("product_{$id}_with_comments");
        
        // Use raw DB query to bypass all caching mechanisms
        $productData = DB::table('products')
            ->where('id', $id)
            ->first();
            
        if (!$productData) {
            abort(404);
        }
        
        // Get comments with raw query to ensure fresh data
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.product_id', $id)
            ->select('comments.*', 'users.fname', 'users.lname')
            ->orderBy('comments.created_at', 'desc')
            ->get();
        
        // Convert to Eloquent models for compatibility
        $product = Product::find($id);
        $product->load(['user', 'category']);
        
        // Manually attach fresh comments
        $product->setRelation('comments', $comments->map(function($comment) {
            $commentModel = new \App\Models\Comment();
            $commentModel->id = $comment->id;
            $commentModel->content = $comment->content;
            $commentModel->user_id = $comment->user_id;
            $commentModel->product_id = $comment->product_id;
            $commentModel->parent_id = $comment->parent_id;
            $commentModel->created_at = $comment->created_at;
            $commentModel->updated_at = $comment->updated_at;
            
            // Create user model
            $user = new \App\Models\User();
            $user->id = $comment->user_id;
            $user->fname = $comment->fname;
            $user->lname = $comment->lname;
            $commentModel->setRelation('user', $user);
            
            return $commentModel;
        }));
        
        // Disable browser cache for this page
        return response()
            ->view('products.show', compact('product'))
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
}
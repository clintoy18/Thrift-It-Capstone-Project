<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::get();
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        $data = $request->validated();
        $categories = Categories::create($data);
        return redirect()->route('categories.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $category)
    {
        // Fetch the products related to the category with status available
        $products = $category->products()->where('status', 'available')->get();
    
        // Return the view with the category and its products
        return view('categories.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function getByUser($userId)
    {
        return Product::where('user_id', $userId)->get();
    }
    public function findWithRelations($id)
    {
        return Product::with(['user','category','comments'])->findOrFail($id);
    }

}

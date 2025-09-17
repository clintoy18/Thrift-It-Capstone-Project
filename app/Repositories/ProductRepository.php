<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Segment;

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

    public function getApproveProducts(Segment $segment)
    {
        return $segment->products()
            ->where('approval_status', 'approved')
            ->with(['category'])
            ->get();
    }

   public function getByStatusPaginated(string $status, int $perPage = 10)
    {
        return Product::with(['user', 'category'])
            ->where('approval_status', $status)  
            ->latest()
            ->paginate($perPage);
    }



}

<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;


class SearchRepository

{
    public function searchProducts(string $query, int $perPage = 10, ?int $selectedCategoryId = null, ?int $selectedBarangayId = null)
    {
        $productsQuery = Product::with(['category', 'user', 'barangay'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhereHas('barangay', function ($b) use ($query) {
                        $b->where('name', 'like', "%{$query}%");
                    });
            })
            ->where(function ($q) {
                $q->where('status', 'available')
                    ->orWhere('approval_status', 'approved');
            });

        // Optional category filter
        if ($selectedCategoryId) {
            $productsQuery->where('category_id', $selectedCategoryId);
        }

        // Optional barangay filter
        if ($selectedBarangayId) {
            $productsQuery->where('barangay_id', $selectedBarangayId);
        }

        return $productsQuery->paginate($perPage);
    }

    public function searchUsers(string $query, int $perPage = 10)
    {
        return User::where('fname', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->paginate(10);
    }
}

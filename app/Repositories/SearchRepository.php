<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;


class SearchRepository

{
    public function searchProducts(string $query, int $perPage = 10)
    {
        return Product::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
             ->orWhereHas('barangay',function($b) use ($query){
                $b->where('name','like',"%{$query}%");
             });
        })
        ->where('status', 'available')
        ->paginate(10);
    }

    public function searchUsers(string $query, int $perPage = 10)
    {
        return User::where('fname', 'like', "%{$query}%")
        ->orWhere('email', 'like', "%{$query}%")
        ->paginate(10);

    }
  

}


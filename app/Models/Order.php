<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'buyer_id',
        'proof',
        'status',
    ];


    
    // Buyer relationship (user who placed the order)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Product relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Seller relationship (owner of the product)
    public function seller()
    {
        return $this->product->user();
    }

    public function isPending() {
    return $this->status === 'pending';
    }

    public function isApproved() {
        return $this->status === 'approved';
    }

    public function isDelivering() {
        return $this->status === 'delivering';
    }

    public function isCompleted() {
        return $this->status === 'completed';
    }

}

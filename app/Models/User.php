<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use App\Models\Barangay;
use App\Models\Donation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'role',
        'password',
        'is_active',
        'points',
        'is_verified',
        'verification_status',
        'verification_document',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 2;
    }

    /**
     * Check if user is an upcycler
     */
    public function isUpcycler(): bool
    {
        return $this->role === 1;
    }

    /**
     * Check if user is a regular user
     */
    public function isRegularUser(): bool
    {
        return $this->role === 0;
    }

    /**
     * Get role name
     */
    public function getRoleNameAttribute(): string
    {
        return match ($this->role) {
            2 => 'Admin',
            1 => 'Upcycler',
            0 => 'User',
            default => 'Unknown'
        };
    }

    public function reportsReceived()
    {
        return $this->hasMany(Report::class, 'reported_user_id');
    }

    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewed_user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function ecoPosts()
    {
        return $this->hasMany(EcoEducationalPost::class);
    }

    // Orders placed by this user (as a buyer)
    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

     // Orders received on products this user is selling
     public function ordersAsSeller()
    {
        return $this->hasManyThrough(Order::class, Product::class);
    }
}

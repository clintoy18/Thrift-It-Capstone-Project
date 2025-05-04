<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
        return match($this->role) {
            2 => 'Admin',
            1 => 'Upcycler',
            0 => 'User',
            default => 'Unknown'
        };
    }

    public function reportsReceived(){
        return $this->hasMany(Report::class, 'reported_user_id');
    }

    public function reviewsWritten(){
        return $this->hasMany(Review::class,'reviewer_id');
    }
    
    public function reviewsReceived(){
        return $this->hasMany(Review::class,'reviewed_user_id');
    }
}

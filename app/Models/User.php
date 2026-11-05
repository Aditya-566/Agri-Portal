<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_verified',
        'avatar',
        'location',
        'phone',
        'bio',
        'earnings',
        'wishlist',
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
            'is_verified' => 'boolean',
            'earnings' => 'float',
            'wishlist' => 'array',
        ];
    }

    // Helper functions
    public function isFarmer()
    {
        return $this->role === 'farmer';
    }

    public function isBuyer()
    {
        return $this->role === 'buyer';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'farmer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function farmerOrders()
    {
        return $this->hasMany(Order::class, 'farmer_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'buyer_id');
    }
}

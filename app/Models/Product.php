<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'harvest_date',
        'location',
        'image_path',
        'farmer_id',
        'category_id',
        'is_organic',
        'status', // 'available', 'sold_out'
    ];

    protected $casts = [
        'price' => 'float',
        'quantity' => 'float',
        'is_organic' => 'boolean',
        'harvest_date' => 'date',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}

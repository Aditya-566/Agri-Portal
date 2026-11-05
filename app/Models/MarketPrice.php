<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MarketPrice extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'market_prices';

    protected $fillable = [
        'crop_name',
        'category_id',
        'current_price',
        'prev_price',
        'trend', // 'up', 'down', 'stable'
        'region',
        'price_history', // Array of [['date', 'price']]
    ];

    protected $casts = [
        'current_price' => 'float',
        'prev_price' => 'float',
        'price_history' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

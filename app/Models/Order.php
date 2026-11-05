<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'buyer_id',
        'farmer_id',
        'items', // Array of items: [['product_id', 'name', 'price', 'quantity', 'image_path']]
        'total_amount',
        'status', // 'pending', 'accepted', 'completed', 'cancelled'
        'shipping_address',
        'payment_id',
        'payment_status', // 'pending', 'paid', 'failed'
    ];

    protected $casts = [
        'total_amount' => 'float',
        'items' => 'array',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}

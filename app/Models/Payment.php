<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method', // 'cod', 'card', 'bank_transfer'
        'status', // 'pending', 'paid', 'failed'
        'transaction_reference',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

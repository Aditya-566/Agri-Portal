<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

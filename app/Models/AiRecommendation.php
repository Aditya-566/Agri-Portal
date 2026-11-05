<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class AiRecommendation extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'ai_recommendations';

    protected $fillable = [
        'soil_type', // 'clay', 'sandy', 'loamy', 'silt', 'peaty'
        'region',
        'season', // 'rabi', 'kharif', 'zaid', 'all'
        'recommended_crops', // Array of [['crop_name', 'expected_yield', 'market_demand_score', 'description']]
        'market_demand_index', // 'high', 'medium', 'low'
    ];

    protected $casts = [
        'recommended_crops' => 'array',
    ];
}

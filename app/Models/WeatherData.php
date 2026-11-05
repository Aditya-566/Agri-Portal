<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class WeatherData extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'weather_data';

    protected $fillable = [
        'region',
        'temperature',
        'humidity',
        'rainfall',
        'forecast', // Array of daily forecasts: [['day', 'temp', 'condition', 'rain_prob']]
        'alerts', // Array of alerts: [['severity', 'type', 'message']]
    ];

    protected $casts = [
        'temperature' => 'float',
        'humidity' => 'float',
        'rainfall' => 'float',
        'forecast' => 'array',
        'alerts' => 'array',
    ];
}

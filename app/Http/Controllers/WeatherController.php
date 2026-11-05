<?php

namespace App\Http\Controllers;

use App\Models\WeatherData;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $region = $request->input('region', 'Punjab');
        
        // Find weather by region
        $weather = WeatherData::where('region', 'regex', "/$region/i")->first();

        // If no weather in database, create a fallback simulation
        if (!$weather) {
            $weather = new WeatherData([
                'region' => ucfirst($region),
                'temperature' => rand(22, 35),
                'humidity' => rand(50, 90),
                'rainfall' => rand(0, 15),
                'forecast' => [
                    ['day' => 'Mon', 'temp' => rand(22, 35), 'condition' => 'Partly Cloudy', 'rain_prob' => rand(10, 50)],
                    ['day' => 'Tue', 'temp' => rand(22, 35), 'condition' => 'Sunny', 'rain_prob' => rand(0, 20)],
                    ['day' => 'Wed', 'temp' => rand(22, 35), 'condition' => 'Showers', 'rain_prob' => rand(50, 90)],
                    ['day' => 'Thu', 'temp' => rand(22, 35), 'condition' => 'Thunderstorms', 'rain_prob' => rand(80, 100)],
                    ['day' => 'Fri', 'temp' => rand(22, 35), 'condition' => 'Sunny', 'rain_prob' => rand(0, 10)],
                ],
                'alerts' => [
                    ['severity' => 'warning', 'type' => 'temperature_fluctuation', 'message' => 'Sudden temperature fluctuations expected. Monitor soil moisture levels closely.']
                ]
            ]);
        }

        return view('weather.index', compact('weather'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AiRecommendation;
use Illuminate\Http\Request;

class AiRecommendationController extends Controller
{
    public function index()
    {
        return view('ai-recommendations.index');
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'soil_type' => 'required|string|in:clay,sandy,loamy,silt,peaty',
            'region' => 'required|string|max:255',
            'season' => 'required|string|in:kharif,rabi,zaid,all',
        ]);

        $soilType = $request->soil_type;
        $region = $request->region;
        $season = $request->season;

        // Try to find seeded ruleset in DB
        $recommendation = AiRecommendation::where('soil_type', $soilType)
            ->where('season', $season)
            ->first();

        // If no exact match, run local algorithmic agricultural matching
        if (!$recommendation) {
            $crops = [];
            if ($soilType === 'clay') {
                $crops = [
                    ['crop_name' => 'Basmati Rice', 'expected_yield' => '4.0 tons/hectare', 'market_demand_score' => 9.2, 'description' => 'Retains water exceptionally well, making it highly compatible for flooded paddy fields.'],
                    ['crop_name' => 'Wheat', 'expected_yield' => '3.5 tons/hectare', 'market_demand_score' => 8.5, 'description' => 'Grows well in heavy soils when properly drained during the rabi season.']
                ];
                $demand = 'high';
            } elseif ($soilType === 'sandy') {
                $crops = [
                    ['crop_name' => 'Peanuts (Groundnuts)', 'expected_yield' => '1.5 tons/hectare', 'market_demand_score' => 7.8, 'description' => 'Sandy soil allows pods to expand easily under the soil surface.'],
                    ['crop_name' => 'Watermelons', 'expected_yield' => '12.0 tons/hectare', 'market_demand_score' => 8.9, 'description' => 'Warm, well-draining sandy soil prevents fruit rot and concentrates sugars.']
                ];
                $demand = 'high';
            } else { // loamy, silt, peaty
                $crops = [
                    ['crop_name' => 'Hybrid Maize', 'expected_yield' => '6.0 tons/hectare', 'market_demand_score' => 8.0, 'description' => 'Requires organic matter and rich aeration typical of loamy and silty soils.'],
                    ['crop_name' => 'Organic Potatoes', 'expected_yield' => '18.0 tons/hectare', 'market_demand_score' => 8.5, 'description' => 'Tuber expansion is clean and disease-free in light, well-drained loamy soils.']
                ];
                $demand = 'medium';
            }

            $recommendation = new AiRecommendation([
                'soil_type' => $soilType,
                'region' => $region,
                'season' => $season,
                'recommended_crops' => $crops,
                'market_demand_index' => $demand
            ]);
        }

        return view('ai-recommendations.index', compact('recommendation', 'soilType', 'region', 'season'));
    }
}

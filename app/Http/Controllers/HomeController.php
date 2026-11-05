<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\MarketPrice;
use App\Models\WeatherData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Featured Products (Organic and Fresh first)
        $featuredProducts = Product::where('status', 'available')
            ->orderBy('is_organic', 'desc')
            ->take(6)
            ->get();

        // 2. Featured Farmers (Verified with high earnings or bio)
        $featuredFarmers = User::where('role', 'farmer')
            ->where('is_verified', true)
            ->take(4)
            ->get();

        // 3. Trending Crop Prices
        $trendingPrices = MarketPrice::orderBy('current_price', 'desc')
            ->take(5)
            ->get();

        // 4. Weather Alerts for home banner
        $weatherAlerts = WeatherData::where('alerts', 'exists', true)
            ->take(3)
            ->get()
            ->pluck('alerts')
            ->flatten(1);

        // 5. Portal Stats Counters
        $stats = [
            'farmers' => User::where('role', 'farmer')->count(),
            'buyers' => User::where('role', 'buyer')->count(),
            'products' => Product::count(),
            'volume' => '1.2M+' // Simulated transaction volume
        ];

        return view('home', compact('featuredProducts', 'featuredFarmers', 'trendingPrices', 'weatherAlerts', 'stats'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function handleContactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // In production, send email. For demo, show success toast
        return back()->with('success', 'Thank you! Your message has been received. We will get back to you shortly.');
    }
}

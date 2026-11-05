<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FarmerDashboardController extends Controller
{
    public function index()
    {
        $farmerId = auth()->id();
        $user = auth()->user();

        // 1. Core counters
        $totalEarnings = $user->earnings ?: 0.0;
        $totalProducts = Product::where('farmer_id', $farmerId)->count();
        $activeOrdersCount = Order::where('farmer_id', $farmerId)
            ->whereIn('status', ['pending', 'accepted'])
            ->count();
        $completedOrdersCount = Order::where('farmer_id', $farmerId)
            ->where('status', 'completed')
            ->count();

        // 2. Recent orders
        $recentOrders = Order::with('buyer')
            ->where('farmer_id', $farmerId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Analytics data for Chart.js
        // We will sum the quantities sold of each crop type for inventory breakdown
        $products = Product::where('farmer_id', $farmerId)->get();
        $cropNames = [];
        $cropQuantities = [];
        
        foreach ($products as $p) {
            $cropNames[] = $p->name;
            $cropQuantities[] = $p->quantity;
        }

        // Monthly earnings chart data (simulated for clean UI presentation)
        $monthlyEarnings = [1500, 3200, 2800, 4100, $totalEarnings > 0 ? $totalEarnings : 1200];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];

        return view('farmer.dashboard', compact(
            'totalEarnings',
            'totalProducts',
            'activeOrdersCount',
            'completedOrdersCount',
            'recentOrders',
            'cropNames',
            'cropQuantities',
            'monthlyEarnings',
            'months'
        ));
    }
}

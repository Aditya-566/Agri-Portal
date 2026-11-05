<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Core counters
        $stats = [
            'total_users' => User::count(),
            'total_farmers' => User::where('role', 'farmer')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        // 2. Pending farmer verifications
        $pendingFarmers = User::where('role', 'farmer')
            ->where('is_verified', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Recent orders across the platform
        $recentOrders = Order::with(['buyer', 'farmer'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 4. Data for SaaS charts
        $monthlyRevenue = [12000, 24000, 18500, 31000, $stats['total_revenue'] > 0 ? $stats['total_revenue'] : 15000];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];

        $userRoles = ['Farmers', 'Buyers', 'Admins'];
        $userCounts = [
            $stats['total_farmers'],
            $stats['total_buyers'],
            User::where('role', 'admin')->count()
        ];

        return view('admin.dashboard', compact(
            'stats',
            'pendingFarmers',
            'recentOrders',
            'monthlyRevenue',
            'months',
            'userRoles',
            'userCounts'
        ));
    }
}

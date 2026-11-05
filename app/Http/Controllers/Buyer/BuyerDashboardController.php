<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = auth()->user();

        // 1. Get counts
        $ordersCount = Order::where('buyer_id', $userId)->count();
        
        $cart = Cart::where('user_id', $userId)->first();
        $cartCount = $cart && !empty($cart->items) ? count($cart->items) : 0;
        
        $wishlistCount = $user->wishlist ? count($user->wishlist) : 0;

        // 2. Recent purchases
        $recentOrders = Order::with('farmer')
            ->where('buyer_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Wishlisted products
        $wishlistProducts = [];
        if ($user->wishlist && !empty($user->wishlist)) {
            $wishlistProducts = Product::whereIn('_id', $user->wishlist)->take(4)->get();
        }

        return view('buyer.dashboard', compact('ordersCount', 'cartCount', 'wishlistCount', 'recentOrders', 'wishlistProducts'));
    }

    public function wishlist()
    {
        $user = auth()->user();
        $products = [];
        
        if ($user->wishlist && !empty($user->wishlist)) {
            $products = Product::whereIn('_id', $user->wishlist)->paginate(9);
        }

        return view('buyer.wishlist', compact('products'));
    }

    public function toggleWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
        ]);

        $productId = $request->product_id;
        $user = User::findOrFail(auth()->id());
        $wishlist = $user->wishlist ?: [];

        if (in_array($productId, $wishlist)) {
            // Remove
            $wishlist = array_values(array_diff($wishlist, [$productId]));
            $status = 'removed';
        } else {
            // Add
            $wishlist[] = $productId;
            $status = 'added';
        }

        $user->wishlist = $wishlist;
        $user->save();

        return back()->with('success', 'Product ' . $status . ' from your wishlist.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $query = Product::where('status', 'available');

        // 1. Search Keyword
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'regex', "/$keyword/i")
                  ->orWhere('description', 'regex', "/$keyword/i")
                  ->orWhere('location', 'regex', "/$keyword/i");
            });
        }

        // 2. Filter Category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 3. Filter Location/Region
        if ($request->has('location') && $request->location != '') {
            $location = $request->location;
            $query->where('location', 'regex', "/$location/i");
        }

        // 4. Filter Organic
        if ($request->has('organic')) {
            $query->where('is_organic', true);
        }

        // 5. Filter Price Range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Paginate results (9 per page)
        $products = $query->paginate(9);

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['farmer', 'category', 'reviews.buyer'])->findOrFail($id);
        
        // Find related products in the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('_id', '!=', $product->id)
            ->where('status', 'available')
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function storeReview(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        $product = Product::findOrFail($productId);

        // Prevent farmer from reviewing their own product
        if ($product->farmer_id === auth()->id()) {
            return back()->with('error', 'You cannot write a review for your own product.');
        }

        // Save review
        Review::create([
            'product_id' => $product->id,
            'buyer_id' => auth()->id(),
            'rating' => (int) $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Your review has been successfully posted.');
    }
}

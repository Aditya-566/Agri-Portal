<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use App\Models\Category;
use Illuminate\Http\Request;

class MarketPriceController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = MarketPrice::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('region') && $request->region != '') {
            $query->where('region', 'regex', '/' . $request->region . '/i');
        }

        $prices = $query->get();

        return view('market-prices.index', compact('prices', 'categories'));
    }
}

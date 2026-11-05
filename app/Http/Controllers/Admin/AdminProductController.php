<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with(['farmer', 'category']);

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where('name', 'regex', "/$keyword/i");
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Crop listing removed by moderator.');
    }

    // Categories management
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
            'description' => 'required|string|max:500',
            'icon' => 'required|string|max:50',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return back()->with('success', 'New Category added successfully.');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        // Check if products exist in category
        $count = Product::where('category_id', $category->id)->count();
        if ($count > 0) {
            return back()->with('error', 'Cannot delete category that contains crop listings.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}

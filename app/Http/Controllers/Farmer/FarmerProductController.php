<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FarmerProductController extends Controller
{
    public function index()
    {
        $products = Product::where('farmer_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('farmer.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('farmer.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'harvest_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|string',
            'is_organic' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float) $request->price,
            'quantity' => (float) $request->quantity,
            'harvest_date' => $request->harvest_date,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'farmer_id' => auth()->id(),
            'is_organic' => $request->has('is_organic'),
            'status' => 'available',
            'image_path' => $imagePath,
        ]);

        return redirect()->route('farmer.products.index')->with('success', 'Crop listing created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->farmer_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('farmer.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->farmer_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'harvest_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|string',
            'is_organic' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|string|in:available,sold_out',
        ]);

        $imagePath = $product->image_path;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float) $request->price,
            'quantity' => (float) $request->quantity,
            'harvest_date' => $request->harvest_date,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'is_organic' => $request->has('is_organic'),
            'status' => $request->status,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('farmer.products.index')->with('success', 'Crop listing updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->farmer_id !== auth()->id()) {
            abort(403);
        }

        // Delete image from storage
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('farmer.products.index')->with('success', 'Crop listing deleted successfully.');
    }
}

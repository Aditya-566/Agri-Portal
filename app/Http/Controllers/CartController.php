<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart()
    {
        return Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['items' => []]
        );
    }

    public function index()
    {
        $cart = $this->getCart();
        $cartItems = [];
        $total = 0;

        if ($cart->items) {
            foreach ($cart->items as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $itemTotal = $product->price * $item['quantity'];
                    $total += $itemTotal;
                    $cartItems[] = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'available_quantity' => $product->quantity,
                        'image_path' => $product->image_path,
                        'farmer_name' => $product->farmer->name,
                        'total' => $itemTotal
                    ];
                }
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->farmer_id === auth()->id()) {
            return back()->with('error', 'Farmers cannot buy their own products.');
        }

        if ($product->quantity < $request->quantity) {
            return back()->with('error', 'Insufficient crop stock available.');
        }

        $cart = $this->getCart();
        $items = $cart->items ?: [];
        $found = false;

        foreach ($items as &$item) {
            if ($item['product_id'] === $product->id) {
                $newQty = $item['quantity'] + $request->quantity;
                if ($product->quantity < $newQty) {
                    return back()->with('error', 'Adding this amount exceeds available stock.');
                }
                $item['quantity'] = $newQty;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $items[] = [
                'product_id' => $product->id,
                'quantity' => (float)$request->quantity
            ];
        }

        $cart->items = $items;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Crop added to your cart.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|numeric|min:0.1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->quantity < $request->quantity) {
            return response()->json(['error' => 'Insufficient stock'], 400);
        }

        $cart = $this->getCart();
        $items = $cart->items ?: [];

        foreach ($items as &$item) {
            if ($item['product_id'] === $product->id) {
                $item['quantity'] = (float)$request->quantity;
                break;
            }
        }

        $cart->items = $items;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function remove($productId)
    {
        $cart = $this->getCart();
        $items = $cart->items ?: [];

        $items = collect($items)->filter(fn($item) => $item['product_id'] !== $productId)->values()->toArray();

        $cart->items = $items;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Crop removed from cart.');
    }
}

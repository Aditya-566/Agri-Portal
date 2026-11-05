<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('buyer_id', auth()->id())->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['farmer', 'buyer'])->findOrFail($id);
        
        // Authorize: only buyer or farmer of this order can view it
        if ($order->buyer_id !== auth()->id() && $order->farmer_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Validate items and group them by farmer
        $groupedItems = [];
        $farmers = [];

        foreach ($cart->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->status !== 'available') {
                return redirect()->route('cart.index')->with('error', 'One of the products in your cart is no longer available.');
            }

            if ($product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Insufficient stock for ' . $product->name);
            }

            $farmerId = $product->farmer_id;
            $farmers[$farmerId] = $product->farmer;

            $groupedItems[$farmerId][] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'image_path' => $product->image_path,
                'item_total' => $product->price * $item['quantity'],
            ];
        }

        return view('cart.checkout', compact('groupedItems', 'farmers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cod,card,bank_transfer',
        ]);

        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Group by farmer
        $groupedItems = [];
        foreach ($cart->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            // Re-verify stock
            if ($product->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Insufficient stock for ' . $product->name);
            }

            $groupedItems[$product->farmer_id][] = [
                'product' => $product,
                'quantity' => $item['quantity']
            ];
        }

        $createdOrders = [];

        // Transaction simulation - create order per farmer
        foreach ($groupedItems as $farmerId => $items) {
            $orderItems = [];
            $totalAmount = 0;

            foreach ($items as $itemData) {
                $product = $itemData['product'];
                $qty = $itemData['quantity'];
                $itemTotal = $product->price * $qty;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty,
                    'image_path' => $product->image_path,
                ];

                $totalAmount += $itemTotal;

                // Deduct inventory
                $product->quantity -= $qty;
                if ($product->quantity <= 0) {
                    $product->status = 'sold_out';
                }
                $product->save();
            }

            // Create Order
            $order = Order::create([
                'buyer_id' => auth()->id(),
                'farmer_id' => $farmerId,
                'items' => $orderItems,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'paid',
            ]);

            // Create Payment log
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => $order->payment_status,
                'transaction_reference' => 'TXN-' . strtoupper(Str::random(10)),
            ]);

            $order->payment_id = $payment->id;
            $order->save();

            // Notify farmer
            Notification::create([
                'user_id' => $farmerId,
                'type' => 'order',
                'title' => 'New Order Received',
                'message' => 'You have received a new order for ' . count($orderItems) . ' crops. Total amount: ₹' . number_format($totalAmount, 2),
                'is_read' => false,
                'data' => ['order_id' => $order->id]
            ]);

            $createdOrders[] = $order;
        }

        // Empty cart
        $cart->items = [];
        $cart->save();

        return redirect()->route('orders.index')->with('success', 'Your order(s) have been placed successfully!');
    }

    public function invoice($id)
    {
        $order = Order::with(['farmer', 'buyer', 'payment'])->findOrFail($id);

        if ($order->buyer_id !== auth()->id() && $order->farmer_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('orders.invoice', compact('order'));
    }
}

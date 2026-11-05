<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class FarmerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('buyer')
            ->where('farmer_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('farmer.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['buyer', 'payment'])->findOrFail($id);

        if ($order->farmer_id !== auth()->id()) {
            abort(403);
        }

        return view('farmer.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:accepted,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);

        if ($order->farmer_id !== auth()->id()) {
            abort(403);
        }

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Prevent updating if already completed or cancelled
        if (in_array($oldStatus, ['completed', 'cancelled'])) {
            return back()->with('error', 'Cannot update a completed or cancelled order.');
        }

        $order->status = $newStatus;

        // If order completed, add earnings to farmer user account
        if ($newStatus === 'completed' && $oldStatus !== 'completed') {
            // Find farmer record directly in DB to update
            $farmer = User::findOrFail(auth()->id());
            $farmer->increment('earnings', $order->total_amount);
            $order->payment_status = 'paid';
            if ($order->payment) {
                $order->payment->update(['status' => 'paid']);
            }
        }

        // If cancelled, restore stock
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->increment('quantity', $item['quantity']);
                    if ($product->status === 'sold_out') {
                        $product->status = 'available';
                        $product->save();
                    }
                }
            }
            if ($order->payment) {
                $order->payment->update(['status' => 'failed']);
            }
        }

        $order->save();

        // Notify Buyer
        Notification::create([
            'user_id' => $order->buyer_id,
            'type' => 'order',
            'title' => 'Order ' . ucfirst($newStatus),
            'message' => 'Your order has been marked as ' . $newStatus . ' by the farmer.',
            'is_read' => false,
            'data' => ['order_id' => $order->id]
        ]);

        return back()->with('success', 'Order status updated to ' . $newStatus);
    }
}

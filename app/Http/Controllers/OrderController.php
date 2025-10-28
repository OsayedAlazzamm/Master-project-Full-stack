<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to order!');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'The cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity'])
        ]);

        foreach ($cart as $mealId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'meal_id' => $mealId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('restaurants.index')->with('success', 'The order has been successfully placed');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('items.meal')->get();
        return view('orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);

        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
            return redirect()->route('orders.index')->with('success', 'Your order has been cancelled.');
        }

        return redirect()->route('orders.index')->with('error', 'This order cannot be cancelled.');
    }

}

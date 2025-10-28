<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $mealId)
    {
        if (!auth()->check()) {
            $request->session()->put('url.intended', url()->previous());
            return redirect()->route('login')->with('error', 'Please login to add meal to the cart');
        }

        $meal = Meal::findOrFail($mealId);
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$mealId])) {
            $cart[$mealId]['quantity'] += $quantity;
        } else {
            $cart[$mealId] = [
                'name' => $meal->name,
                'price' => $meal->price,
                'quantity' => $quantity,
                'image' => $meal->image_path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'The meal has been added to the cart');
    }


    public function remove($mealId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$mealId])) {
            unset($cart[$mealId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'The meal has been removed from the cart');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'The cart has been empitied ');
    }
}

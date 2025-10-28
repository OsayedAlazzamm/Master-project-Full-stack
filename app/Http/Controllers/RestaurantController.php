<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::latest()->get();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        $meals = $restaurant->meals;
        return view('restaurants.show', compact('restaurant', 'meals'));
    }
}

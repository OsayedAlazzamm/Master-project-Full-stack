<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('admin.restaurants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('logos', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        Restaurant::create($data);

        return redirect()->route('admin.restaurants.index')->with('success', 'The restaurant has been added successfully');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $request->file('logo_path')->store('logos', 'public');
        }

        $restaurant->update($data);

        return redirect()->route('admin.restaurants.index')->with('success', 'The restaurant has been updated successfully');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->back()->with('success', 'The restaurant has been removed successfully');
    }
}

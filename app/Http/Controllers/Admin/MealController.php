<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MealController extends Controller
{
   public function index(Request $request)
    {
        $restaurants = Restaurant::all(); 
        $query = Meal::with('restaurant');

        if ($request->restaurant_id) {
            $query->where('restaurant_id', $request->restaurant_id);
        }

        $meals = $query->get();

        return view('admin.meals.index', compact('meals', 'restaurants'));
    }


    public function create()
    {
        $restaurants = Restaurant::all();
        return view('admin.meals.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('meals', 'public');
        }

        Meal::create($data);

        return redirect()->route('admin.meals.index')->with('success', 'The meal has been added successfully');
    }

    public function edit(Meal $meal)
    {
        $restaurants = Restaurant::all();
        return view('admin.meals.edit', compact('meal', 'restaurants'));
    }

    public function update(Request $request, Meal $meal)
    {
        $data = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('meals', 'public');
        }

        $meal->update($data);

        return redirect()->route('admin.meals.index')->with('success', 'The meal has been updated successfully');
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();
        return redirect()->back()->with('success', 'The meal has been removed successfully');
    }
}

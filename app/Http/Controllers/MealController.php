<?php

namespace App\Http\Controllers;

use App\Models\Meal;

class MealController extends Controller
{
    public function show($id)
    {
        $meal = Meal::findOrFail($id);
        return view('meals.show', compact('meal'));
    }
}

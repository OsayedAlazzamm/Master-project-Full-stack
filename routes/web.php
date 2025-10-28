<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Admin\MealController as AdminMealController;

/*
|--------------------------------------------------------------------------
| Public routes (guests can view restaurants & meals)
|--------------------------------------------------------------------------
*/
Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{slug}', [RestaurantController::class, 'show'])->name('restaurants.show');

/*
|--------------------------------------------------------------------------
| Authenticated user routes (regular users only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'userOnly'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{meal}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{meal}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Orders
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');
});

/*
|--------------------------------------------------------------------------
| Admin routes (admins only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('restaurants', AdminRestaurantController::class);
        Route::resource('meals', AdminMealController::class);
    });

/*
|--------------------------------------------------------------------------
| Dashboard redirect (after login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('restaurants.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

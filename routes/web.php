<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/cart',  "cart")->name("cart");
    Route::get('/shopping-cart', 'productCart')->name('shopping.cart');
    Route::get('/product/{id}', 'addProducttoCart')->name('addProduct.to.cart');
    Route::patch('/update-shopping-cart', 'updateCart')->name('update.sopping.cart');
    Route::delete('/delete-cart-product', 'deleteProduct')->name('delete.cart.product');
    Route::get('/test', "test")->name("test");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php
use App\Http\Controllers\shoppingCart;

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

Route::controller(shoppingCart::class)->group(function () {
    Route::get('/', 'index')->name('shoppingCart.index');
    Route::post('/add_to_cart', 'add_to_cart')->name('shoppingCart.add_to_cart');
    Route::get('/cart', 'cart')->name('shoppingCart.cart');
    Route::post('/shoppingCart_remove', 'shoppingCart_remove')->name('shoppingCart.remove');
    Route::post('/shoppingCart_edit', 'shoppingCart_edit')->name('shoppingCart.edit');
    Route::post('/shoppingCart_remove_all', 'shoppingCart_remove_all')->name('shoppingCart.remove_all');
    Route::get('/shoppingCart_checkout', 'shoppingCart_checkout')->name('shoppingCart.checkout');
    Route::post('/shoppingCart_checkout', 'shoppingCart_checkout_post')->name('shoppingCart.checkout_post');
});

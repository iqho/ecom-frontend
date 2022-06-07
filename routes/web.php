<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\Products\CartController;
use App\Http\Controllers\Products\OrderController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    $products = Http::get(config('app.backend_url') . '/api/api-products')->json();
    return view('products.index', ['products' => $products['product'], 'categories' => $products['categories']]);
})->name('products.index');

Route::get('details/{id}', function ($id) {
    $product = Http::get(config('app.backend_url') . '/api/api-products/' . $id)->json();
    return view('products.details', ['product' => $product['product']]);
})->name('products.details');

Route::get('/category/{id}', function ($id) {
    $category = Http::get(config('app.backend_url') . '/api/api-categories/' . $id)->json();
    return view('categories.show', ['category' => $category['category']]);
})->name('categories.products');

Route::view('/vue', 'products.vue.index')->name('products.vue.index');
//Route::view('/vue/{id}', 'products.vue.details')->name('products.vue.details');
Route::get('/vue/{id}', function ($id) {
    return view('products.vue.details', compact('id'));
})->name('products.vue.details');

Route::get('/cart', [CartController::class, 'cartIndex'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('confirm-order', [OrderController::class, 'confirmOrder'])->name('confirmOrder');

Auth::routes();
Route::get('/login2', [ApiLoginController::class, 'login'])->name('login2');
Route::post('/api-login', [ApiLoginController::class, 'loginData'])->name('loginData');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

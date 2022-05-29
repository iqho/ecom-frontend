<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    $products = Http::get(config('app.backend_url').'/api/api-products')->json();
    return view('products.index', ['products'=>$products['product']]);
})->name('products.index');

Route::get('details/{id}', function($id){
    $product = Http::get(config('app.backend_url').'/api/api-products/'.$id)->json();
    return view('products.details', ['product'=>$product['product']]);
})->name('products.details');

Route::view('/vue', 'products.vue.index')->name('products.vue.index');
//Route::view('/vue/{id}', 'products.vue.details')->name('products.vue.details');
Route::get('/vue/{id}', function($id){
    return view('products.vue.details', compact('id'));
})->name('products.vue.details');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

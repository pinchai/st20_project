<?php
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart_index');

Route::post('/cart/add-to-cart', [CartController::class, 'addToCart']);
Route::post('/cart/add-cart-qty', [CartController::class, 'addCartQty']);
Route::post('/cart/remove-cart-qty', [CartController::class, 'removeCartQty']);
Route::post('/cart/delete-cart-item', [CartController::class, 'deleteCartItem']);
Route::post('/cart/toggleCartItemSelection', [CartController::class, 'toggleCartItemSelection']);


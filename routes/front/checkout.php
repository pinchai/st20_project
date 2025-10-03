<?php
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout_index');

Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('place_order');

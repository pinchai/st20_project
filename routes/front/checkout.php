<?php
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout_index');

Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('place_order');



Route::post('/checkout/generate-qr', [CheckoutController::class, 'generateQr'])
    ->name('generate_qr');

Route::post('/check_payment_status', [CheckoutController::class, 'checkPaymentStatus'])
    ->name('check_payment_status');

Route::get('/customer-thank', [CheckoutController::class, 'customerThank']);


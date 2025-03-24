<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\ProductController;

Route::post('/search-amazon-product', [ProductController::class, 'show']);

// use App\Http\Controllers\StripeController;

// Route::post('/stripe/checkout', [StripeController::class, 'checkout']);
// Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
// Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

use App\Http\Controllers\StripeController;


Route::post('/stripe/payment-intent', [StripeController::class, 'createPaymentIntent']);

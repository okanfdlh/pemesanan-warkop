<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\MenuController as ApiMenuController;

Route::get('/', function () {
    return view('home');
});
Route::get('/chart', function () {
    return view('chart');
});

Route::get('/welcome`', function () {
    return view('welcome');
});


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/payment/success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/order/receipt/{order_id}', [OrderController::class, 'printReceipt'])->name('order.receipt');
Route::get('/order/receipt/{order_id}/pdf', [OrderController::class, 'downloadReceiptPDF'])->name('order.receipt.pdf');
Route::post('/order/{orderId}/update-payment-status', [OrderController::class, 'updatePaymentStatus']);
Route::get('/api/orders', [ApiOrderController::class, 'index']);
Route::get('/api/orders/{id}', [ApiOrderController::class, 'show']);
Route::get('/api/products', [ApiProductController::class, 'getProducts']);
// routes/api.php


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
});



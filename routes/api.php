<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

// User Routes
Route::get('/users', [AuthController::class, 'getAllUsers']);

// Product Routes
Route::get('/products', [ProductController::class, 'getProducts']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

// Order Routes
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/order/cash', [OrderController::class, 'storeCashOrder']);
});

// Stock Management Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/stock', [StockController::class, 'index']);
    Route::get('/stock/summary', [StockController::class, 'summary']);
    Route::get('/stock/low-stock', [StockController::class, 'lowStock']);
    Route::get('/stock/{id}', [StockController::class, 'show']);
    Route::put('/stock/{id}', [StockController::class, 'updateStock']);
    Route::post('/stock/bulk-update', [StockController::class, 'bulkUpdate']);
});

// Analytics Routes
Route::get('/pendapatan', [OrderController::class, 'getPendapatan']);
Route::get('/produk-terlaris', [OrderController::class, 'getProdukTerlaris']);

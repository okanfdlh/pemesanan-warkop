<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email atau password salah'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token
    ]);
});

Route::middleware('auth:sanctum')->post('/products', [ApiProductController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/products/{id}', [ApiProductController::class, 'destroy']);
    Route::put('/products/{id}', [ApiProductController::class, 'update']);
});



Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
Route::get('/pendapatan', [OrderController::class, 'getPendapatan']);
Route::get('/produk-terlaris', [OrderController::class, 'getProdukTerlaris']);
Route::middleware('auth:sanctum')->post('/order/cash', [OrderController::class, 'storeCashOrder']);

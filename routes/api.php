<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']); // Endpoint login

// Endpoint tambah menu hanya bisa diakses jika user sudah login
Route::middleware('auth:sanctum')->post('/menu/tambah', [MenuController::class, 'store']);

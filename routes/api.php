<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/fetch-cart', [CartController::class, 'fetchCart']);
    Route::post('/add-to-cart', [CartController::class, 'updateCart']);
    Route::post('/remove-cart', [CartController::class, 'removeCartItem']);
    Route::post('/order-place', [CartController::class, 'placeOrder']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

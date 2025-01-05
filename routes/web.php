<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('check.login');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('save.user');
});

Route::get('/', [UserController::class, 'profile'])->name('user.dashboard');
Route::post('/check-product-availability', [ProductController::class, 'checkAvailability'])->name('check.product.availability');



Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:1'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/add-product', [ProductController::class, 'addProductForm'])->name('add.products.form');
        Route::post('/admin/store-product', [ProductController::class, 'storeProduct'])->name('products.store');
        Route::get('/admin/products', [ProductController::class, 'productsList'])->name('admin.products.list');
        Route::get('/admin/view-product/{id}', [ProductController::class, 'viewProduct'])->name('admin.products.show');
        Route::get('/admin/edit-product/{id}', [ProductController::class, 'editProduct'])->name('admin.products.edit');
        Route::post('/admin/update-product/{id}', [ProductController::class, 'updateProduct'])->name('admin.product.update');
        Route::post('/admin/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('admin.products.destroy');
    });

    
    Route::middleware(['role:2'])->group(function () {
        Route::post('user/update-cart', [OrderController::class, 'updateCart'])->name('user.update.cart');
        Route::get('/user/cart', [OrderController::class, 'showCart'])->name('user.show.cart');
        Route::post('/user/cart-remove', [OrderController::class, 'removeCartItem'])->name('user.cart.remove');
        Route::post('/user/cart-order', [OrderController::class, 'placeOrder'])->name('user.cart.order');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

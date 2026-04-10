<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [ProductController::class, 'showProductToUser']);

    Route::delete('/dashboard/cart/{id}', [CartController::class, 'destroy']);
    Route::post('/dashboard/checkout', [OrderController::class, 'store'])->name('checkout');

Route::get('/dashboard/checkout', [CartController::class, 'checkout']);
Route::post('/dashboard/checkout', [OrderController::class, 'store']);
Route::get('/dashboard/order', [OrderController::class, 'showToUser']);

Route::get('/admindashboard', [ShowController::class, 'jumlahUser']);
Route::get('/admindashboard/order', [OrderController::class, 'show']);
    Route::delete('/dashboard/cart/{id}', [CartController::class, 'destroy']);
    Route::get('/dashboard/cart', [CartController::class, 'index']);
    Route::post('/dashboard/product/{id}', [CartController::class, 'store']);
    Route::get('/dashboard/product/{id}', [ProductController::class, 'showProduct']);
    Route::delete('/dashboard/product/{id}', [ProductController::class, 'destroy']);

            Route::delete('/admindashboard/category/{id}', [CategoryController::class, 'destroy']);
        Route::post('/admindashboard/category', [CategoryController::class, 'store'])->name('tambah');
        Route::get('/admindashboard/category', [CategoryController::class, 'show']);
        Route::get('/admindashboard/category/{id}/edit', [CategoryController::class, 'edit']);
        Route::post('/admindashboard/category/{id}', [CategoryController::class, 'update']);

    Route::get('/admindashboard/user', [ProductController::class, 'userview']);
Route::get('/admindashboard', [ProductController::class, 'admindashboard']);
    Route::get('/admindashboard/chat', [ChatController::class, 'adminIndex']);
    Route::post('/admindashboard/chat', [ChatController::class, 'store']);
    Route::get('/dashboard/chat', [ChatController::class, 'index']);
    Route::post('/dashboard/chat', [ChatController::class, 'store']);
    Route::get('/admindashboard/product', [ProductController::class, 'show']);
    Route::get('/admindashboard/product/tambah', [ProductController::class, 'create']);
    Route::post('/admindashboard/product/tambah', [ProductController::class, 'store']);
    Route::get('/admindashboard/product/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/admindashboard/product/{id}', [ProductController::class, 'update']);
    Route::delete('/admindashboard/product/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard/user', [ProductController::class, 'showUser']);
    Route::get('/dashboard/order', [OrderController::class, 'showToUser']);
    Route::post('/admindashboard/order/{order}/status', [OrderController::class, 'updateStatus']);
    Route::get('/admindashboard/product/tambah',[CategoryController::class, 'showToTambahProduk']);
Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard.search');
});

Route::post('/register', [AuthController::class, 'register'])->name('registers');
Route::get('/register', [AuthController::class, 'registers']);
Route::post('/login', [AuthController::class, 'login'])->name('logins');
Route::get('/login', [AuthController::class, 'logins']);
Route::get('/', [ProductController::class, 'mainpage']);

<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
require __DIR__ . '/auth.php';

// Trang chính
Route::get('/', function () {
    return view('welcome');
});

// Định nghĩa route cho xác thực
Auth::routes();

// Route cho trang người dùng
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route cho admin
Route::prefix('admin')->middleware(['auth', 'is_admin','verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/users', UserController::class);
});
<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/', action: [HomeController::class, 'index'])->name('admin.index');
    Route::resource('/category', CategoryController::class);

});

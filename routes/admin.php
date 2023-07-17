<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

// Auth Routes
Route::get('/login', [AuthController::class, 'Login']);
Route::post('/login', [AuthController::class, 'LoginSubmit'])->name('admin.login_submit');


// Private Routes
Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'Profile'])->name('admin.profile');
    Route::get('/logout', [AuthController::class, 'Logout'])->name('admin.logout');

    // Category
    Route::resource('category',CategoryController::class);

    // Product
    Route::resource('product',ProductController::class);
    Route::get('product/{status}/{slug}', [ProductController::class, 'Status']);
    Route::post('product/image/delete', [ProductController::class, 'DeleteImage'])->name('product.image_delete');



});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


    
// Auth
Route::get('/login', [AuthController::class, 'Login'])->name('admin.login');
Route::get('/register', [AuthController::class, 'Register'])->name('admin.register');

Route::post('/login', [AuthController::class, 'LoginSubmit'])->name('admin.login_submit');
Route::post('/register', [AuthController::class, 'RegisterSubmit'])->name('admin.register_submit');




Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
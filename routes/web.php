<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;



/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', [HomeController::class, 'Index']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// تسجيل جميع المسارات بميدل وير التوكن الجديد
Route::middleware('api.token')->group(function () {
    Route::post('/profile', [App\Http\Controllers\Api\ApiController::class, 'profile']);
    Route::post('/order', [App\Http\Controllers\Api\ApiController::class, 'store']);
    Route::post('/check/order', [App\Http\Controllers\Api\ApiController::class, 'orderShow']);
    Route::post('/products', [App\Http\Controllers\Api\ApiController::class, 'products']);
});

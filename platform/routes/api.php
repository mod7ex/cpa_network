<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;

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

Route::apiResource('offers', OfferController::class);


Route::apiResource('users', UserController::class);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function () {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'admin',

], function () {

    Route::post('login', [App\Http\Controllers\Admins\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\Admins\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\Admins\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Admins\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Admins\AuthController::class, 'me']);
});
<?php

use App\Models\Os;
use App\Models\Niche;
use App\Models\Device;
use App\Models\Browser;
use App\Models\Country;
use App\Models\Vertical;
use App\Models\Restriction;
use App\Models\PayoutType;
use App\Models\PromotionMethod;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\StatsController;

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

Route::apiResource('countries', CountryController::class);

Route::apiResource('timezones', TimezoneController::class);

Route::apiResource('paymentmethods', PaymentMethodController::class);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function () {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
    Route::get('isloggedin', [App\Http\Controllers\AuthController::class, 'isLoggedIn']);
});


// user stats
Route::get('/stats/today', [StatsController::class, 'today']);
Route::post('/stats/filtered', [StatsController::class, 'filtered']);
Route::post('/stats/donut', [StatsController::class, 'donut']);


Route::get('offersfilter', function(){
    return [
        'promotion_methods' =>PromotionMethod::all(),
        'niches' =>Niche::all(),
        'payout_types' =>PayoutType::all(),
        'verticals' =>Vertical::all(),
        'devices' =>Device::all(),
        'oss' =>Os::all(),
        'browsers' =>Browser::all(),
        'countries' =>Country::all(),
	'restrictions' => Restriction::all(),
    ];
})->middleware('auth:api');


// ***************** ADMIN

Route::group([

    'middleware' => 'api',
    'prefix' => 'admin',

], function () {

    Route::post('login', [App\Http\Controllers\Admins\AuthController::class, 'login']);
    // Route::post('register', [App\Http\Controllers\Admins\AuthController::class, 'register']);
    Route::post('logout', [App\Http\Controllers\Admins\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Admins\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Admins\AuthController::class, 'me']);


    // Admin stats
    Route::get('/stats/today', [App\Http\Controllers\Admins\StatsController::class, 'today']);
    Route::get('/stats/top-users', [App\Http\Controllers\Admins\StatsController::class, 'topUsers']);
    Route::get('/stats/top-offers', [App\Http\Controllers\Admins\StatsController::class, 'topOffers']);

    Route::post('/stats/filtered', [App\Http\Controllers\Admins\StatsController::class, 'filtered']);
    Route::post('/stats/donut', [App\Http\Controllers\Admins\StatsController::class, 'donut']);


    // **********
    Route::apiResource('offers', OfferController::class);

    Route::apiResource('users', UserController::class);

    Route::apiResource('countries', CountryController::class);

    Route::apiResource('timezones', TimezoneController::class);

    Route::apiResource('paymentmethods', PaymentMethodController::class);
});
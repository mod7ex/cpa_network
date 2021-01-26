<?php

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

        // $user = User::create([
        //     'contact_infos' => Arr::only($request->validated(), [
        //         'first_name',
        //         'last_name',
        //         'website',
        //         'country_id',
        //         'street_address',
        //         'city',
        //         'region',
        //         'zip_code',
        //         'phone_number',
        //         'skype',
        //         'telegram'
        //     ]),

        //     'email' => Arr::get($request->validated(), 'email'),
        //     'password' => Hash::make(Arr::get($request->validated(), 'password')),
        // ]);
        
});